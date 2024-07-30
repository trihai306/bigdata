<?php

namespace Adminftr\FileManager\Services;

use Adminftr\FileManager\Events\UnzipCreated;
use Adminftr\FileManager\Events\UnzipFailed;
use Adminftr\FileManager\Events\ZipCreated;
use Adminftr\FileManager\Events\ZipFailed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class Zip
{
    protected $zip;

    protected $request;
    //protected $pathPrefix;

    /**
     * Zip constructor.
     */
    public function __construct(ZipArchive $zip, Request $request)
    {
        $this->zip = $zip;
        $this->request = $request;
        //$this->pathPrefix = Storage::disk($request->input('disk'))->path();
        //->getDriver()
        //->getAdapter()
        //->getPathPrefix();
    }

    /**
     * Create new zip archive
     */
    public function create(): array
    {

        if ($this->createArchive()) {
            return [
                'result' => [
                    'status' => 'success',
                    'message' => null,
                ],
            ];
        }

        return [
            'result' => [
                'status' => 'warning',
                'message' => 'zipError',
            ],
        ];
    }

    /**
     * Extract
     */
    public function extract(): array
    {
        if ($this->extractArchive()) {
            return [
                'result' => [
                    'status' => 'success',
                    'message' => null,
                ],
            ];
        }

        return [
            'result' => [
                'status' => 'warning',
                'message' => 'zipError',
            ],
        ];
    }

    protected function prefixer($path): string
    {
        return Storage::disk($this->request->input('disk'))->path($path);
    }

    /**
     * Create zip archive
     */
    protected function createArchive(): bool
    {
        // elements list
        $elements = $this->request->input('elements');

        // create or overwrite archive
        if ($this->zip->open(
            $this->createName(),
            ZIPARCHIVE::OVERWRITE | ZIPARCHIVE::CREATE
        ) === true
        ) {
            // files processing
            if ($elements['files']) {
                foreach ($elements['files'] as $file) {
                    $this->zip->addFile(
                        $this->prefixer($file),
                        basename($file)
                    );
                }
            }

            // directories processing
            if ($elements['directories']) {
                $this->addDirs($elements['directories']);
            }

            $this->zip->close();

            event(new ZipCreated($this->request));

            return true;
        }

        event(new ZipFailed($this->request));

        return false;
    }

    /**
     * Archive extract
     */
    protected function extractArchive(): bool
    {
        $zipPath = $this->prefixer($this->request->input('path'));

        $rootPath = dirname($zipPath);

        // extract to new folder
        $folder = $this->request->input('folder');

        if ($this->zip->open($zipPath) === true) {
            $this->zip->extractTo($folder ? $rootPath.'/'.$folder : $rootPath);
            $this->zip->close();

            event(new UnzipCreated($this->request));

            return true;
        }

        event(new UnzipFailed($this->request));

        return false;
    }

    /**
     * Add directories - recursive
     */
    protected function addDirs(array $directories)
    {
        foreach ($directories as $directory) {

            // Create recursive directory iterator
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($this->prefixer($directory)),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                // Get real and relative path for current item
                $filePath = $file->getRealPath();
                $relativePath = substr(
                    $filePath,
                    strlen($this->fullPath($this->request->input('path')))
                );

                if (! $file->isDir()) {
                    // Add current file to archive
                    $this->zip->addFile($filePath, $relativePath);
                } else {
                    // add empty folders
                    if (! glob($filePath.'/*')) {
                        $this->zip->addEmptyDir($relativePath);
                    }
                }
            }
        }
    }

    /**
     * Create archive name with full path
     */
    protected function createName(): string
    {
        return $this->fullPath($this->request->input('path'))
            .$this->request->input('name');
    }

    /**
     * Generate full path
     */
    protected function fullPath($path): string
    {
        return $path ? $this->prefixer($path).'Zip.php/' : $this->prefixer('');
    }
}
