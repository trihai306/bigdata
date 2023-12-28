<?php

namespace Modules\User\Livewire\Permission\Roles;

use DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $roles;

    // Add the listeners array
    protected $listeners = ['roleUpdated' => 'reloadRoles', 'deleteRole' => 'deleteRole'];

    public function mount()
    {

        $this->reloadRoles();
    }

    public function reloadRoles()
    {

        $this->roles = Role::with('permissions')->get();
    }

    public function render()
    {
        return view('user::livewire.roles.index', [
            'roles' => $this->roles
        ]);
    }

    public function deleteRole($roleId)
    {
        $role = Role::findById($roleId);

        if ($role) {
            DB::transaction(function () use ($role) {
                // Detach all permissions before deleting
                $role->permissions()->detach();
                $role->delete();
            });

            session()->flash('success', 'Role deleted successfully.');
            $this->reloadRoles();
        } else {
            session()->flash('error', 'Role not found.');
        }
    }
}

