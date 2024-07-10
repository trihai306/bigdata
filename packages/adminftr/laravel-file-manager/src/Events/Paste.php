<?php

namespace Future\FileManager\Events;

use Illuminate\Http\Request;

class Paste
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
     * @var array
     */
    private $clipboard;

    /**
     * Paste constructor.
     */
    public function __construct(Request $request)
    {
        $this->disk = $request->input('disk');
        $this->path = $request->input('path');
        $this->clipboard = $request->input('clipboard');
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

    /**
     * @return array
     */
    public function clipboard()
    {
        return $this->clipboard;
    }
}
