<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    // One student has one profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
