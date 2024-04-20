<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::whereNotIn('name', ['admin'])->get();
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function roles(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.users.roles', compact('user', 'roles', 'permissions'));
    }
    public function permissions(Request $request, Role $role, Permission $permissions)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.users.permissions', compact('roles', 'permissions'));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate(['name' => ['required']]);
        $user->update($validated);
        return redirect()->route('admin.users.index')->with('message', 'User updated successfully');
    }
    public function assignRole(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'roleSelect' => 'required|string|exists:roles,name', // Make sure the selected role exists in the roles table
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Sync the user's roles with the selected role
        $user->syncRoles([$request->roleSelect]);

        // Redirect back or wherever you need
        return redirect()->back()->with('success', 'Role assigned successfully');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('error', 'You cannot delete an admin user.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
