<?php

namespace Adminftr\FileManager;

use Adminftr\FileManager\Events\Deleted;
use Adminftr\FileManager\Services\TransferService\TransferFactory;
use Adminftr\FileManager\Traits\CheckTrait;
use Adminftr\FileManager\Traits\ContentTrait;
use Adminftr\FileManager\Traits\PathTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use League\Flysystem\FilesystemException;
use manager\src\Services\ConfigService\ConfigRepository;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileManager
{
    use CheckTrait, ContentTrait, PathTrait;

    public ConfigRepository $configRepository;

    /**
     * FileManager constructor.
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * Initialize App
     */
    public function initialize(): array
    {
        if (! config()->has('file-manager')) {
            return [
                'result' => [
                    'status' => 'danger',
                    'message' => 'noConfig',
                ],
            ];
        }

        $config = [
            'acl' => $this->configRepository->getAcl(),
            'leftDisk' => $this->configRepository->getLeftDisk(),
            'rightDisk' => $this->configRepository->getRightDisk(),
            'leftPath' => $this->configRepository->getLeftPath(),
            'rightPath' => $this->configRepository->getRightPath(),
            'windowsConfig' => $this->configRepository->getWindowsConfig(),
            'hiddenFiles' => $this->configRepository->getHiddenFiles(),
        ];

        // disk list
        foreach ($this->configRepository->getDiskList() as $disk) {
            if (array_key_exists($disk, config('filesystems.disks'))) {
                $config['disks'][$disk] = Arr::only(
                    config('filesystems.disks')[$disk], ['driver']
                );
            }
        }

        // get language
        $config['lang'] = app()->getLocale();

        return [
            'result' => [
                'status' => 'success',
                'message' => null,
            ],
            'config' => $config,
        ];
    }

    /**
     * Get files and directories for the selected path and disk
     *
     *
     * @throws FilesystemException
     */
    public function content($disk, $path): array
    {
        $content = $this->getContent($disk, $path);

        return [
            'result' => [
                'status' => 'success',
                'message' => null,
            ],
            'directories' => $content['directories'],
            'files' => $content['files'],
        ];
    }

    /**
     * Get part of the directory tree
     *
     *
     * @throws FilesystemException
     */
    public function tree($disk, $path): array
    {
        $directories = $this->getDirectoriesTree($disk, $path);

        return [
            'result' => [
                'status' => 'success',
                'message' => null,
            ],
            'directories' => $directories,
        ];
    }

    /**
     * Upload files
     *
     * @param  string|null  $disk
     * @param  string|null  $path
     * @param  array|null  $files
     * @param  bool  $overwrite
     */
    public function upload($disk, $path, $files, $overwrite): array
    {
        $fileNotUploaded = false;

        foreach ($files as $file) {
            // skip or overwrite files
            if (! $overwrite && Storage::disk($disk)->exists($path.'/'.$file->getClientOriginalName())) {
                continue;
            }

            // check file size
            if ($this->configRepository->getMaxUploadFileSize()
                && $file->getSize() / 1024 > $this->configRepository->getMaxUploadFileSize()
            ) {
                $fileNotUploaded = true;

                continue;
            }

            // check file type
            if ($this->configRepository->getAllowFileTypes()
                && ! in_array(
                    $file->getClientOriginalExtension(),
                    $this->configRepository->getAllowFileTypes()
                )
            ) {
                $fileNotUploaded = true;

                continue;
            }

            $name = $file->getClientOriginalName();
            if ($this->configRepository->getSlugifyNames()) {
                $name = Str::slug(
                    Str::replace(
                        '.'.$file->getClientOriginalExtension(),
                        '',
                        $name
                    )
                ).'src'.$file->getClientOriginalExtension();
            }
            // overwrite or save file
            Storage::disk($disk)->putFileAs(
                $path,
                $file,
                $name
            );
        }

        if ($fileNotUploaded) {
            return [
                'result' => [
                    'status' => 'warning',
                    'message' => 'notAllUploaded',
                ],
            ];
        }

        return [
            'result' => [
                'status' => 'success',
                'message' => 'uploaded',
            ],
        ];
    }

    /**
     * Delete files and folders
     */
    public function delete($disk, $items): array
    {
        $deletedItems = [];

        foreach ($items as $item) {
            if (! Storage::disk($disk)->exists($item['path'])) {
                continue;
            } else {
                if ($item['type'] === 'dir') {
                    Storage::disk($disk)->deleteDirectory($item['path']);
                } else {
                    Storage::disk($disk)->delete($item['path']);
                }
            }

            $deletedItems[] = $item;
        }

        event(new Deleted($disk, $deletedItems));

        return [
            'result' => [
                'status' => 'success',
                'message' => 'deleted',
            ],
        ];
    }

    /**
     * Copy / Cut - Files and Directories
     */
    public function paste($disk, $path, $clipboard): array
    {
        // compare disk names
        if ($disk !== $clipboard['disk']) {

            if (! $this->checkDisk($clipboard['disk'])) {
                return $this->notFoundMessage();
            }
        }

        $transferService = TransferFactory::build($disk, $path, $clipboard);

        return $transferService->filesTransfer();
    }

    /**
     * Rename file or folder
     */
    public function rename($disk, $newName, $oldName): array
    {
        Storage::disk($disk)->move($oldName, $newName);

        return [
            'result' => [
                'status' => 'success',
                'message' => 'renamed',
            ],
        ];
    }

    /**
     * Download selected file
     */
    public function download($disk, $path): StreamedResponse
    {
        // if file name not in ASCII format
        if (! preg_match('/^[\x20-\x7e]*$/', basename($path))) {
            $filename = Str::ascii(basename($path));
        } else {
            $filename = basename($path);
        }

        return Storage::disk($disk)->download($path, $filename);
    }

    /**
     * Create thumbnails
     *
     *
     * @return Response|mixed
     *
     * @throws BindingResolutionException
     */
    public function thumbnails($disk, $path): mixed
    {
        return response()->make(
            Image::read(
                Storage::disk($disk)->get($path))
                ->coverDown(80, 80)
                ->encode(),
            200,
            ['Content-Type' => Storage::disk($disk)->mimeType($path)]
        );
    }

    /**
     * Image preview
     *
     *
     * @throws BindingResolutionException
     */
    public function preview($disk, $path): mixed
    {
        return response()->make(
            Image::read(Storage::disk($disk)->get($path))->encode(),
            200,
            ['Content-Type' => Storage::disk($disk)->mimeType($path)]
        );
    }

    /**
     * Get file URL
     */
    public function url($disk, $path): array
    {
        return [
            'result' => [
                'status' => 'success',
                'message' => null,
            ],
            'url' => Storage::disk($disk)->url($path),
        ];
    }

    /**
     * Create new directory
     *
     *
     * @return array
     */
    public function createDirectory($disk, $path, $name)
    {
        $directoryName = $this->newPath($path, $name);

        if (Storage::disk($disk)->exists($directoryName)) {
            return [
                'result' => [
                    'status' => 'warning',
                    'message' => 'dirExist',
                ],
            ];
        }

        Storage::disk($disk)->makeDirectory($directoryName);
        $directoryProperties = $this->directoryProperties(
            $disk,
            $directoryName
        );

        // add directory properties for the tree module
        $tree = $directoryProperties;
        $tree['props'] = ['hasSubdirectories' => false];

        return [
            'result' => [
                'status' => 'success',
                'message' => 'dirCreated',
            ],
            'directory' => $directoryProperties,
            'tree' => [$tree],
        ];
    }

    /**
     * Create new file
     */
    public function createFile($disk, $path, $name): array
    {
        $path = $this->newPath($path, $name);

        if (Storage::disk($disk)->exists($path)) {
            return [
                'result' => [
                    'status' => 'warning',
                    'message' => 'fileExist',
                ],
            ];
        }

        Storage::disk($disk)->put($path, '');
        $fileProperties = $this->fileProperties($disk, $path);

        return [
            'result' => [
                'status' => 'success',
                'message' => 'fileCreated',
            ],
            'file' => $fileProperties,
        ];
    }

    /**
     * Update file
     */
    public function updateFile($disk, $path, $file): array
    {
        Storage::disk($disk)->putFileAs(
            $path,
            $file,
            $file->getClientOriginalName()
        );

        $filePath = $this->newPath($path, $file->getClientOriginalName());
        $fileProperties = $this->fileProperties($disk, $filePath);

        return [
            'result' => [
                'status' => 'success',
                'message' => 'fileUpdated',
            ],
            'file' => $fileProperties,
        ];
    }

    /**
     * Stream file - for audio and video
     */
    public function streamFile($disk, $path): StreamedResponse
    {
        // if file name not in ASCII format
        if (! preg_match('/^[\x20-\x7e]*$/', basename($path))) {
            $filename = Str::ascii(basename($path));
        } else {
            $filename = basename($path);
        }

        return Storage::disk($disk)->response($path, $filename, ['Accept-Ranges' => 'bytes']);
    }
}
