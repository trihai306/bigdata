<?php

namespace Adminftr\FileManager\Events;

use Illuminate\Http\Request;

class Download
{
    /**
     * @var string
     */
    private $disk;

    /**
     * @var string
     */
    private $path;

    /**
     * Download constructor.
     */
    public function __construct(Request $request)
    {
        $this->disk = $request->input('disk');
        $this->path = $request->input('path');
    }

    /**
     * @return string
     */
    public function disk()
    {
        return $this->disk;
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->path;
    }
}
