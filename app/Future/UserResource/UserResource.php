<?php
namespace App\Future\UserResource;
use Future\Core\Http\Resource\BaseResource;
use Modules\User\Livewire\Form;
use Modules\User\Livewire\Table;

class UserResource extends BaseResource
{
    public function __construct()
    {
        parent::__construct(
            new Table(),
            new Form()
        );
    }
}