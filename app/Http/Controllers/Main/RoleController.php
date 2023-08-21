<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Tables\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('main.roles.index', ['roles' => Roles::class]);
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('main.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permission);

        Toast::title('Role berhasil di buat');
        return to_route('roles.index');
    }

    public function show(Role $role)
    {
        $rolePermissions = $role->permissions;
        // $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permission.id')
        // ->where('role_has_permissions.role_id', $role->id)->get();
        return view('main.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = $role->permissions;
        // $rolePermissions = DB::table('role_has_permissions')->where('role_has_pemissions.role_id', $role->id)
        // ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        // ->all();

        return view('main.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permission);

        Toast::title('Role berhasil di update!')->center()->backdrop()->autoDismiss(1);
        return to_route('roles.index');
    }

    public function deletePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            // Jika permission ada pada role
            $role->revokePermissionTo($permission);
            Toast::title('Permission berhasil dihapus')->center()->backdrop()->autoDismiss(1);
            return back();
        }

        // Jika permission tidak ada pada role
        Toast::warning('Permission tidak ada')->center()->backdrop()->autoDismiss(3);
        return back();
    }

    public function destroy(Role $role)
    {
        $role->delete();
        Toast::title('Role berhasil di delete')->center()->backdrop()->autoDismiss(1);
        return back();
    }
}
