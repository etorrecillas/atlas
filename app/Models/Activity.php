<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $appends = [
        'finish_date',
        'type_name',
        'value',
    ];

    protected $fillable = [
        'title',
        'short',
        'activity_type_id',
        'military_organization_id',
    ];

    protected $casts = [
        'finished_date' => 'date',
    ];

    //Accessors
    public function getFinishDateAttribute()
    {
        return $this->finished_date->format('d/m/Y');
    }

    public function getTypeNameAttribute()
    {
        if(isset($this->type->short)) {
            return $this->type->title. ' (' . $this->type->short . ')';
        } else {
            return $this->type->name;
        }
    }

    public function getValueAttribute()
    {
        if(isset($this->value_in_cents)) {
            return $this->value_in_cents/100;
//            return "R$ ".number_format($this->value_in_cents/100,2, ',', '.');
        } else {
            return "N/A";
        }
    }

    //Relationships
    public function type()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id', 'id');
    }

    public function militaryOrganization()
    {
        return $this->belongsTo(MilitaryOrganization::class, 'military_organization_id', 'id');
    }
}
