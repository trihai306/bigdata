<?php

namespace Future\FileManager\Controllers;

use Future\FileManager\Events\BeforeInitialization;
use Future\FileManager\Events\Deleting;
use Future\FileManager\Events\DirectoryCreated;
use Future\FileManager\Events\DirectoryCreating;
use Future\FileManager\Events\DiskSelected;
use Future\FileManager\Events\Download;
use Future\FileManager\Events\FileCreated;
use Future\FileManager\Events\FilesUploaded;
use Future\FileManager\Events\FilesUploading;
use Future\FileManager\Events\FileUpdate;
use Future\FileManager\Events\Paste;
use Future\FileManager\Events\Rename;
use Future\FileManager\Events\Unzip as UnzipEvent;
use Future\FileManager\Events\Zip as ZipEvent;
use Future\FileManager\FileManager;
use Future\FileManager\Requests\RequestValidator;
use Future\FileManager\Services\Zip;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use League\Flysystem\FilesystemException;
use manager\src\Events\FileCreating;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileManagerController extends Controller
{
    /**
     * @var FileManager
     */
    public $fm;

    /**
     * FileManagerController constructor.
     */
    public function __construct(FileManager $fm)
    {
        $this->fm = $fm;
    }

    public function index()
    {
        return view('file-manager::index');
    }

    /**
     * Initialize file manager
     */
    public function initialize(): JsonResponse
    {
        event(new BeforeInitialization());

        return response()->json(
            $this->fm->initialize()
        );
    }

    /**
     * Get files and directories for the selected path and disk
     *
     *
     * @throws FilesystemException
     */
    public function content(RequestValidator $request): JsonResponse
    {
        return response()->json(
            $this->fm->content(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Directory tree
     *
     *
     * @throws FilesystemException
     */
    public function tree(RequestValidator $request): JsonResponse
    {
        return response()->json(
            $this->fm->tree(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Check the selected disk
     */
    public function selectDisk(RequestValidator $request): JsonResponse
    {
        event(new DiskSelected($request->input('disk')));

        return response()->json([
            'result' => [
                'status' => 'success',
                'message' => 'diskSelected',
            ],
        ]);
    }

    /**
     * Upload files
     */
    public function upload(RequestValidator $request): JsonResponse
    {
        event(new FilesUploading($request));

        $uploadResponse = $this->fm->upload(
            $request->input('disk'),
            $request->input('path'),
            $request->file('files'),
            $request->input('overwrite')
        );

        event(new FilesUploaded($request));

        return response()->json($uploadResponse);
    }

    /**
     * Delete files and folders
     */
    public function delete(RequestValidator $request): JsonResponse
    {
        event(new Deleting($request));

        $deleteResponse = $this->fm->delete(
            $request->input('disk'),
            $request->input('items')
        );

        return response()->json($deleteResponse);
    }

    /**
     * Copy / Cut files and folders
     */
    public function paste(RequestValidator $request): JsonResponse
    {
        event(new Paste($request));

        return response()->json(
            $this->fm->paste(
                $request->input('disk'),
                $request->input('path'),
                $request->input('clipboard')
            )
        );
    }

    /**
     * Rename
     */
    public function rename(RequestValidator $request): JsonResponse
    {
        event(new Rename($request));

        return response()->json(
            $this->fm->rename(
                $request->input('disk'),
                $request->input('newName'),
                $request->input('oldName')
            )
        );
    }

    /**
     * Download file
     */
    public function download(RequestValidator $request): StreamedResponse
    {
        event(new Download($request));

        return $this->fm->download(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * Create thumbnails
     *
     *
     * @return Response|mixed
     *
     * @throws BindingResolutionException
     */
    public function thumbnails(RequestValidator $request): mixed
    {
        return $this->fm->thumbnails(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * Image preview
     */
    public function preview(RequestValidator $request): mixed
    {
        return $this->fm->preview(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * File url
     */
    public function url(RequestValidator $request): JsonResponse
    {
        return response()->json(
            $this->fm->url(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }

    /**
     * Create new directory
     */
    public function createDirectory(RequestValidator $request): JsonResponse
    {
        event(new DirectoryCreating($request));

        $createDirectoryResponse = $this->fm->createDirectory(
            $request->input('disk'),
            $request->input('path'),
            $request->input('name')
        );

        if ($createDirectoryResponse['result']['status'] === 'success') {
            event(new DirectoryCreated($request));
        }

        return response()->json($createDirectoryResponse);
    }

    /**
     * Create new file
     */
    public function createFile(RequestValidator $request): JsonResponse
    {
        event(new FileCreating($request));

        $createFileResponse = $this->fm->createFile(
            $request->input('disk'),
            $request->input('path'),
            $request->input('name')
        );

        if ($createFileResponse['result']['status'] === 'success') {
            event(new FileCreated($request));
        }

        return response()->json($createFileResponse);
    }

    /**
     * Update file
     */
    public function updateFile(RequestValidator $request): JsonResponse
    {
        event(new FileUpdate($request));

        return response()->json(
            $this->fm->updateFile(
                $request->input('disk'),
                $request->input('path'),
                $request->file('file')
            )
        );
    }

    /**
     * Stream file
     */
    public function streamFile(RequestValidator $request): mixed
    {
        return $this->fm->streamFile(
            $request->input('disk'),
            $request->input('path')
        );
    }

    /**
     * Create zip archive
     *
     *
     * @return array
     */
    public function zip(RequestValidator $request, Zip $zip)
    {
        event(new ZipEvent($request));

        return $zip->create();
    }

    /**
     * Extract zip archive
     *
     *
     * @return array
     */
    public function unzip(RequestValidator $request, Zip $zip)
    {
        event(new UnzipEvent($request));

        return $zip->extract();
    }

    /**
     * Integration with ckeditor 4
     */
    public function ckeditor(): Factory|View
    {
        return view('file-manager::ckeditor');
    }

    /**
     * Integration with TinyMCE v4
     */
    public function tinymce(): Factory|View
    {
        return view('file-manager::tinymce');
    }

    /**
     * Integration with TinyMCE v5
     */
    public function tinymce5(): Factory|View
    {
        return view('file-manager::tinymce5');
    }

    /**
     * Integration with SummerNote
     */
    public function summernote(): Factory|View
    {
        return view('file-manager::summernote');
    }

    /**
     * Simple integration with input field
     */
    public function fmButton(): Factory|View
    {
        return view('file-manager::fmButton');
    }
}
