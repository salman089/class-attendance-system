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
}
