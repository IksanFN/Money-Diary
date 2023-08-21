<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('main.users.index', ['users' => Users::class]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('main.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'required',
        ]);
        // return dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->roles);

        Toast::title('Users berhasil dibuat')->backdrop()->center()->autoDismiss(1);
        return to_route('users.index');
    }

    public function show(User $user)
    {
        return view('main.users.show', compact('user'));
    }

    public function edit(Request $request, User $user)
    {
        $roles = Role::all();
        $userRole = $user->roles;
        return view('main.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'roles' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $user->assignRole($request->roles);

        Toast::title('User berhasil di update')->center()->backdrop()->autoDismiss(1);
        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        Toast::title('User berhasil di hapus')->center()->backdrop()->autoDismiss(1);
        return back();
    }
    
}
