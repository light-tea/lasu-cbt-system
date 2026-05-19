<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'matric_no',
        'email',
        'password',
        'role',
        'face_descriptor',
        'face_image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN CREATED EXAMS
    |--------------------------------------------------------------------------
    */
    public function exams()
    {
        return $this->hasMany(Exam::class, 'created_by');
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT EXAM ATTEMPTS
    |--------------------------------------------------------------------------
    */
    public function examAttempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }
}