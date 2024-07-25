<?php

namespace Future\FileManager\Services\TransferService;

abstract class Transfer
{
    public $disk;

    public $path;

    public $clipboard;

    /**
     * Transfer constructor.
     */
    public function __construct($disk, $path, $clipboard)
    {
        $this->disk = $disk;
        $this->path = $path;
        $this->clipboard = $clipboard;
    }

    /**
     * Transfer files and folders
     */
    public function filesTransfer(): array
    {
        try {
            // determine the type of operation
            if ($this->clipboard['type'] === 'copy') {
                $this->copy();
            } elseif ($this->clipboard['type'] === 'cut') {
                $this->cut();
            }
        } catch (\Exception $exception) {
            return [
                'result' => [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ],
            ];
        }

        return [
            'result' => [
                'status' => 'success',
                'message' => 'copied',
            ],
        ];
    }

    abstract protected function copy();

    abstract protected function cut();
}