<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MilitaryOrganization extends Model
{
    protected $appends = [
        'users_count',
        'activities_count',
    ];

    protected $fillable = [
        'title',
        'short',
    ];

    //Accessors
    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    public function getActivitiesCountAttribute()
    {
        return $this->activities()->count();
    }

    //Relationships
    public function users()
    {
        $users = User::select('users.*')
            ->where('military_organization_id', $this->id)
            ->join('military_organizations', 'military_organizations.id', '=', 'users.military_organization_id')
            ->join('rankings', 'rankings.id', '=', 'users.ranking_id')
            ->orderBy('rankings.sorting')
            ->orderBy('users.name')
            ->get();

        return $users;

    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'military_organization_id', 'id');
    }


}
