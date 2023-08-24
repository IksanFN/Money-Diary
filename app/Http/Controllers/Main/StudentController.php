<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Major;
use App\Models\User;
use App\Tables\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('main.students.index', ['students' => Students::class]);
    }

    public function create()
    {
        $kelases = Kelas::pluck('name', 'id')->toArray();
        $users = User::whereNot('name', 'admin')->pluck('name', 'id')->toArray();
        $majors = Major::pluck('name', 'id')->toArray();
        return view('main.students.create', compact('users', 'kelases', 'majors'));
    }
}
