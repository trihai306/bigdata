<?php

namespace Future\Table\Future\Tables\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class Actions {
    /**
     * @var Action[]
     */
    private array $actions = [];
    protected ?Model $data = null;
    private string $renderMethod = 'renderAsDropdown';
    /**
     * Add action to actions list
     *
     * @param Action $action

     */
    public function addAction(Action $action, Model $data = null): void {

        if ($data) {
            $action->setId($data->id);
            $action->setData($data);
        }
        $this->actions[] = $action;
    }
    /**
     * Initialize list of actions
     *
     * @param Action[] $actions
     */
    public function schema(array $actions,Model $data = null): void {
        foreach ($actions as $action) {
            $this->addAction($action,$data);
        }
    }

    /**
     * Render actions as buttons
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function renderAsButtons(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        return view('future::base.buttons', ['actions' => $this->actions]);
    }

    /**
     * Render actions as dropdown
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function renderAsDropdown() {
        return view('future::base.dropdown', ['actions' => $this->actions]);
    }

    public function render() {
        return $this->{$this->renderMethod}();
    }

    public function setData(Model $data=null)
    {
        $this->data = $data;
    }

    /**
     * Create and initialize Actions instance
     *
     * @param Action[] $actions
     * @param string $renderMethod
     * @return Actions
     */
    public static function create(array $actions,Model $data = null,string $renderMethod = 'renderAsDropdown'): self {

        $instance = new static();
        $instance->schema($actions,$data);
        $instance->setRenderMethod($renderMethod);
        return $instance;
    }

    /**
     * Set rendering method
     *
     * @param string $method
     */
    private function setRenderMethod(string $method = 'renderAsDropdown'): void {
        if (method_exists($this, $method)) {
            $this->renderMethod = $method;
        }
    }
}
