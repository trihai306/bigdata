<?php
namespace Modules\User\app\Http\Controllers;


use Modules\Core\Http\Resource\BaseResource;
use Modules\User\Livewire\Permission\Form;
use Modules\User\Livewire\Permission\Table;
use Spatie\Permission\Models\Role;


class PermissionResource extends BaseResource
{
    public function __construct()
    {
        parent::__construct(
            new Table(),
            new Form()
        );
    }

    public function role()
    {

        return view('user::role');
    }

    public function showRole($id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);

            return view('user::showRole', compact('role'));
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Role not found');
        }
    }
}
