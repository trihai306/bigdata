<?php

namespace Modules\Permission\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permission::index');
    }

    public function create()
    {
        return view('permission::create');
    }

    public function edit($id)
    {
        return view('permission::edit',compact('id'));
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
