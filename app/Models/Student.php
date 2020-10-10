<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'gender', 'religion', 'dad_name', 'mom_name', 'address', 'birth_date', 'avatar'
    ];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/avatar-1.png');
        }

        return asset('images/' . $this->avatar);
    }

    public function lesson()
    {
        return $this->belongsToMany(Lesson::class)->withPivot(['score']);
    }

}
