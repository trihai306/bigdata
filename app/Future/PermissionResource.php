<?php
namespace App\Future;


use App\Future\PermissionResource\Form;
use App\Future\PermissionResource\Table;
use Future\Core\Http\Resource\BaseResource;
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

        return view('role');
    }

    public function showRole($id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);

            return view('showRole', compact('role'));
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Role not found');
        }
    }
}