<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'title',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(PermissionCategory::class, 'category_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
