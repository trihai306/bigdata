<?php
namespace Modules\Core\Livewire\Tables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class Column
{
    public $name;
    public $label;
    public $sortable;
    public $default;
    public $searchable;
    public $visible;
    public $renderCallback;
    public $width;
    public $textAlign;
    protected $iconCallback;
    public function __construct(string $name, string $label = null, bool $sortable = false, $default = null, bool $searchable = false, bool $visible = true, callable $renderCallback = null)
    {
        $this->name = $name;
        $this->label = $label ?? $name;
        $this->sortable = $sortable;
        $this->default = $default;
        $this->searchable = $searchable;
        $this->visible = $visible;
        $this->renderCallback = $renderCallback;
    }

    public static function make($name, $label = null, $sortable = false)
    {
        return new static($name, $label, $sortable);
    }

    public function sortable()
    {
        $this->sortable = true;
        return $this;
    }

    public function searchable()
    {
        $this->searchable = true;
        return $this;
    }

    public function hide()
    {
        $this->visible = false;
        return $this;
    }

    public function default($value)
    {
        $this->default = $value;
        return $this;
    }

    public function renderUsing(callable $callback)
    {
        $this->renderCallback = function($model,$value) use ($callback) {
            return new HtmlString(call_user_func($callback, $model,$value));
        };
        return $this;
    }


    public function renderImage( callable $urlCallback,$width = 50, $height = 50)
    {
        $this->renderCallback = function($model) use ($width, $height, $urlCallback) {
            $imageUrl = call_user_func($urlCallback, $model);
            return new HtmlString("<img src='{$imageUrl}' width='{$width}' class='' height='{$height}'/>");
        };
        return $this;
    }


    public function renderLink(callable $urlCallback)
    {
        $this->renderCallback = function($model) use ($urlCallback) {
            $url = call_user_func($urlCallback, $model);
            return new HtmlString("<a href='{$url}'>{$model->{$this->name}}</a>");
        };
        return $this;
    }

    public function renderHtml(callable $callback)
    {
        $this->renderCallback = $callback;
        return $this;
    }

    public function render(Model $model)
    {
        $path = explode('.', $this->name);
        $value = count($path) > 1 ? data_get($model, $this->name) : $model->{$this->name};

        // Xử lý đặc biệt cho collection từ relationship
        if ($value instanceof Collection) {
            $value = $value->pluck('name')->join(', '); // Ví dụ cho role names
        }

        $iconHtml = '';
        if ($this->iconCallback) {
            $iconHtml = call_user_func($this->iconCallback, $model);
        }

        $renderedValue = $this->renderCallback ? call_user_func($this->renderCallback, $model, $value) : $value;
        return new HtmlString($iconHtml . $renderedValue);
    }




    public function badge(array $colorMap, array $labelMap = [])
    {
        $this->renderCallback = function($model,$value) use ($colorMap,$labelMap) {
            $color = $colorMap[$value] ?? 'secondary'; // Mặc định là màu 'secondary' nếu không khớp
            $label = $labelMap[$value] ?? $value; // Mặc định là giá trị nếu không khớp
            return "<span class='badge text-bg-{$color}'>{$label}</span>";
        };
        return $this;
    }

    public function color($colorCallback, $isBackground = false)
    {
        $this->renderCallback = function($value) use ($colorCallback, $isBackground) {
            $color = call_user_func($colorCallback, $value);
            $style = $isBackground ? "background-color: {$color};" : "color: {$color};";
            return "<span style='{$style}'>{$value}</span>";
        };
        return $this;
    }

    public function dateTime($format = 'Y-m-d H:i:s')
    {
        $this->renderCallback = function($model,$value) use ($format) {
            return (new \DateTime($value))->format($format);
        };
        return $this;
    }

    public function since()
    {
        $this->renderCallback = function($model,$value) {
            $date = new \DateTime($value);
            $now = new \DateTime();
            $interval = $now->diff($date);
            return $interval->format('%y years, %m months, %d days');
        };
        return $this;
    }

    public function numeric($decimalPlaces = 0, $decimalSeparator = '.', $thousandsSeparator = ',')
    {
        $this->renderCallback = function($value) use ($decimalPlaces, $decimalSeparator, $thousandsSeparator) {
            return number_format($value, $decimalPlaces, $decimalSeparator, $thousandsSeparator);
        };
        return $this;
    }

    public function money($currencySymbol)
    {
        $this->renderCallback = function($value) use ($currencySymbol) {
            return $currencySymbol . ' ' . number_format($value, 2);
        };
        return $this;
    }

    public function limit($limit = 50)
    {
        $this->renderCallback = function($value) use ($limit) {
            if (strlen($value) > $limit) {
                return substr($value, 0, $limit) . '...';
            }
            return $value;
        };
        return $this;
    }

    public function tooltip($placement = 'top')
    {
        $this->renderCallback = function($model,$value) use ($placement) {
            return "<span data-bs-toggle='tooltip' data-bs-placement='{$placement}' title='{$value}'>{$value}</span>";
        };
        return $this;
    }

    public function width($width='100px')
    {
        $this->width = $width;
        return $this;
    }

    public function textAlign($textAlign = 'left')
    {
        $this->textAlign = $textAlign;
        return $this;
    }

    public function icon($callback)
    {
        $this->iconCallback = $callback;
        return $this;
    }
}
