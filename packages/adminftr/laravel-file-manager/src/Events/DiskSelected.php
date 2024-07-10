<?php

namespace Future\FileManager\Events;

class DiskSelected
{
    /**
     * @var string
     */
    private $disk;

    /**
     * DiskSelected constructor.
     */
    public function __construct($disk)
    {
        $this->disk = $disk;
    }

    /**
     * @return string
     */
    public function disk()
    {
        return $this->disk;
    }
}
