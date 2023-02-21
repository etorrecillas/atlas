<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'title',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->orderBy('title');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->orderBy('email');
    }
}
