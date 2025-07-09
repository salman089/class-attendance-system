<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'name',
        'section',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function head_of_department()
    {
        return $this->belongsTo(User::class, 'head_of_department_id');
    }
}
