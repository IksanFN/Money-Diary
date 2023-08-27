<?php

namespace App\Http\Controllers\Main;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Major;
use App\Models\Student;
use App\Tables\Students;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StudentStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentUpdate;
use ProtoneMedia\Splade\Facades\Toast;

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

    public function store(StudentStore $request)
    {
        // return dd($request->all());
        $student = User::find($request->user_id);
        $kelas = Kelas::find($request->kelas_id);
        $major = Major::find($request->major_id);

        Student::create([
            'uuid' => Str::uuid(32),
            'user_id' => $request->user_id,
            'kelas_id' => $request->kelas_id,
            'major_id' => $request->major_id,
            'student_avatar' => $student->avatar,
            'student_name' => $student->name,
            'student_nisn' => $student->nisn,
            'student_kelas' => $kelas->name,
            'student_major' => $major->name,
            'gender' => $request->gender,
            'student_phone' => $request->student_phone,
            'alamat' => $request->alamat,
        ]);

        Toast::title('Student berhasil di mapping!')->center()->backdrop()->autoDismiss(1);
        return to_route('students.index');        
    }

    public function show(Student $student)
    {
        return view('main.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $kelases = Kelas::pluck('name', 'id')->toArray();
        $users = User::whereNot('name', 'admin')->pluck('name', 'id')->toArray();
        $majors = Major::pluck('name', 'id')->toArray();
        return view('main.students.edit', compact('student', 'users', 'kelases', 'majors'));
    }

    public function update(StudentUpdate $request, Student $student)
    {
        $student->update($request->all());
        Toast::title('Student berhasil di update')->center()->backdrop()->autoDismiss(1);
        return to_route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        Toast::title('Student berhasil di hapus')->center()->backdrop()->autoDismiss(1);
        return back();
    }
}
