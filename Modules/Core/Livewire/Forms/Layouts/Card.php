<?php
namespace Modules\Core\Livewire\Forms\Layouts;

class Card{
    protected $title;
    protected $fields = [];
    protected $classes = '';
    protected $headerClasses = '';
    protected $bodyClasses = '';
    protected $footer;
    protected $attributes = [];

    public static function make(string $title=null)
    {
        $instance = new static;
        $instance->title = $title;
        return $instance;
    }

    public function classes(string $classes)
    {
        $this->classes = $classes;
        return $this;
    }

    public function headerClasses(string $classes)
    {
        $this->headerClasses = $classes;
        return $this;
    }

    public function bodyClasses(string $classes)
    {
        $this->bodyClasses = $classes;
        return $this;
    }

    public function footer(string $footer)
    {
        $this->footer = $footer;
        return $this;
    }

    public function addField($field)
    {
        $this->fields[] = $field;
        return $this;
    }

    public function addAttribute(string $name, string $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function schema(array $rows)
    {
        foreach ($rows as $row) {
            $this->addField($row);
        }
        return $this;
    }

    public function render()
    {
        $html = '<div class="card '.$this->classes.' shadow-sm"'; // Added shadow and max-width for styling
        foreach ($this->attributes as $name => $value) {
            $html .= ' '.$name.'="'.$value.'"';
        }
        $html .= '>';
        if ($this->title) {
            $html .= '<div class="card-header '.$this->headerClasses.' h4 mt-3">'.$this->title.'</div>'; // Use h4 for better SEO
        }
        $html .= '<div class="card-body '.$this->bodyClasses.'">';
        foreach ($this->fields as $field) {
            $html .= $field->render();
        }
        $html .= '</div>';
        if ($this->footer) {
            $html .= '<div class="card-footer text-muted">'.$this->footer.'</div>'; // Added text-muted for styling
        }
        $html .= '</div>';
        return $html;
    }

}
