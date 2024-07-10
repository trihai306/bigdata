<?php

namespace Future\Table\Future\Components\Columns;

use Future\Table\Future\Components\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ImageColumn extends Column
{
    public ?string $height = '60';

    protected string $disk = 'public';

    protected bool $circular = false;

    protected $stacked;

    public ?string $width = '60';

    protected string $defaultImageUrl = '';

    public static function make(string $name, ?string $label = null)
    {
        return new static($name, $label);
    }

    public function stacked(callable $callback)
    {
        $this->stacked = $callback;

        return $this;
    }

    public function disk(string $disk)
    {
        $this->disk = $disk;

        return $this;
    }

    public function square(int $size)
    {
        $this->height = $size;
        $this->width = $size;

        return $this;
    }

    public function circular()
    {
        $this->circular = true;

        return $this;
    }

    // Method to set default image URL
    public function defaultImage(string $url)
    {
        $this->defaultImageUrl = $url;

        return $this;
    }

    public function render(Model $model)
    {
        if (! filter_var($model->{$this->name}, FILTER_VALIDATE_URL)) {
            $model->{$this->name} = Storage::disk($this->disk)->url($model->{$this->name});
        }
        $url = $this->renderCallback ? call_user_func($this->renderCallback, $model) : $model->{$this->name};

        // Check if the URL has a scheme (http or https)
        $parsedUrl = parse_url($url);
        if (! isset($parsedUrl['scheme'])) {
            // If no scheme is found, prepend http:// to the URL
            $url = 'http://'.$url;
        }

        $circularClass = $this->circular ? 'rounded-circle' : 'rounded';

        return new HtmlString("<img src='{$url}' class='img-fluid {$circularClass}'
style='height: {$this->height}px;width: {$this->width}px'  alt=''/>");
    }
}
