<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $appends = [
        'log_date',
    ];

    protected $fillable = [
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getLogDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
}
