<?php
namespace Modules\DataSystem\app\Http\Controllers;

use Future\Core\Http\Resource\BaseResource;
use Illuminate\Http\Request;
use Modules\DataSystem\Livewire\Form;
use Modules\DataSystem\Livewire\Table;

class DataSystemResource extends BaseResource
{
    public function __construct()
    {
        parent::__construct(
            new Table(),
            new Form()
        );
    }
}
