<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use App\Tables\Users;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserStore;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;

class UserController extends Controller
{
    public function index()
    {
        return view('main.users.index', ['users' => Users::class]);
    }

    public function create()
    {
        $roles = Role::whereNot('name', 'admin')->get();
        return view('main.users.create', compact('roles'));
    }

    public function store(UserStore $request)
    {
        // File avatar
        $image = $request->file('avatar');
        $nameImage = Str::random(32).$request->avatar->getClientOriginalName();
        // return dd($request->all());
        $image->storeAs('public/users/avatar', $nameImage);

        
        $user = User::create([
            'name' => $request->name,
            'nisn' => $request->nisn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $nameImage,
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
        $roles = Role::whereNot('name', 'admin')->get();
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
