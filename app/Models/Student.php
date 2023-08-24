<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'kelas_id',
        'jurusan_id',
        'student_avatar',
        'student_name',
        'student_nisn',
        'student_kelas',
        'student_major',
        'student_phone',
        'gender',
        'alamat',
    ];
}
