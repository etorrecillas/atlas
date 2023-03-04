<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $appends = [
        'finish_date',
        'type_name',
        'value',
        'om_name',
        'sector_view',
        'type_act_index',
    ];

    protected $fillable = [
        'activity_type_id',
        'military_organization_id',
        'user_name',
        'title',
        'finished_date',
        'reference_number',
        'comments',
        'value_in_cents',
        'sector',
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

        if(isset($this->type->id)) {
            if(isset($this->type->short)) {
                return $this->type->title. ' (' . $this->type->short . ')';
            } else {
                return $this->type->title;
            }
        } else {
            return "Sem Tipo";
        }

//        if(isset($this->sector)) {
//            $str .= " ***".$this->sector."***";
//        } else {
//            $str .= " ***Sem Sub***";
//        }
//
//        return $str;

    }

    public function getSectorViewAttribute()
    {
        if(isset($this->sector)) {
            return $this->sector;
        } else {
            return "Sem Sub";
        }
    }

    public function getTypeActIndexAttribute()
    {
        return $this->type_name . " ***" . $this->sector_view . "***";
    }

    public function getOmNameAttribute()
    {
        if(isset($this->militaryOrganization->id)) {
            return $this->militaryOrganization->short;
        } else {
            return "Sem OM";
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

    public function getValueShowAttribute()
    {
        if(isset($this->value_in_cents)) {
//            return $this->value_in_cents/100;
            return "R$ ".number_format($this->value_in_cents/100,2, ',', '.');
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
