<?php
namespace Modules\Permission\app\Http\Controllers;


use Modules\Core\Http\Resource\BaseResource;

use Modules\Permission\Livewire\Form;
use Modules\Permission\Livewire\Table;
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

        return view('permission::role');
    }

    public function showRole($id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);

            return view('permission::showRole', compact('role'));
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Role not found');
        }
    }
}
