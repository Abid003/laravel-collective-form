<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'student_id',
        'address',
        'dob',
        'photo',
    ];

    // Belongs to Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
