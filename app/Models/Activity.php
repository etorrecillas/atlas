<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'short',
        'activity_type_id',
        'military_organization_id',
    ];

    public function type()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id', 'id');
    }

    public function militaryOrganization()
    {
        return $this->belongsTo(MilitaryOrganization::class, 'military_organization_id', 'id');
    }
}
