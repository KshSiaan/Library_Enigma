<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }
    // public function create()
    // {
    //     return view('admin.roles.create');
    // }
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);

        return to_route('admin.roles.index')->with('message', 'Role updated successfully');
    }
    public function edit(Request $request, Role $role, Permission $permissions)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required']]);
        $role->update($validated);
        $role->givePermissionTo($request->permission);
        return redirect()->route('admin.roles.index')->with('message', 'Role updated successfully');
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('message', 'Role deleted');
    }

    public function givePermission(Request $request, Role $role)
    {
        // Validate the request data
        $validated = $request->validate([
            'perm' => 'array', // Assuming perm is the name of the checkboxes group
        ]);

        // Get the submitted permissions
        $submittedPermissions = $validated['perm'] ?? [];

        // Get the permissions currently associated with the role
        $currentPermissions = $role->permissions->pluck('id')->toArray();

        // Find permissions to be added (submitted but not currently associated)
        $permissionsToAdd = array_diff($submittedPermissions, $currentPermissions);

        // Give the role the new permissions
        foreach ($permissionsToAdd as $permissionId) {
            $permission = Permission::find($permissionId);
            if ($permission) {
                $role->givePermissionTo($permission);
            }
        }

        // Find permissions to be revoked (currently associated but not submitted)
        $permissionsToRevoke = array_diff($currentPermissions, $submittedPermissions);

        // Revoke permissions
        foreach ($permissionsToRevoke as $permissionId) {
            $permission = Permission::find($permissionId);
            if ($permission) {
                $role->revokePermissionTo($permission);
            }
        }

        // Redirect back with success message
        return back()->with('message', 'Permissions updated successfully');
    }
}
