<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'semester'
    ];

    public function student()
    {
        return $this->belongsToMany(Student::class);
    }
}
