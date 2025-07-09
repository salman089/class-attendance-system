<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postcode',
        'country',
        'phone',
        'date_of_birth',
        'gender',
        'is_active',
        'is_superuser',
        'guardian_name',
        'guardian_relation',
        'guardian_phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function subjectsTaught()
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }

    public function hasAccess(string $permissionName)
    {
        if ($this->is_superuser) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role->hasAccess($permissionName)) {
                return true;
            }
        }

        return false;
    }

    public function scopeWithRole($query, $roleNames)
    {
        return $query->whereHas('roles', function ($q) use ($roleNames) {
            $q->whereIn('name', (array) $roleNames);
        });
    }
}
