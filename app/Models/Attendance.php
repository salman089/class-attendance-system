<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'classroom_id',
        'date',
        'status',
        'remark',
        'marked_by',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function marker()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }
}
