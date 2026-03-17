<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    protected $fillable = ['name', 'slug'];

    public function getTableNameAttribute(): string
    {
        // derive from slug like "create-users" => "users"
        return Str::of((string) $this->slug)->afterLast('-')->toString();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
