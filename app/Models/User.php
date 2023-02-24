<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ranking_id',
        'military_branch_id',
        'specialty_id',
        'military_organization_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //RELATIONSHIPS
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function ranking()
    {
        return $this->belongsTo(Ranking::class, 'ranking_id', 'id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id', 'id');
    }

    public function militaryOrg()
    {
        return $this->belongsTo(MilitaryOrganization::class, 'military_organization_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(MilitaryBranch::class, 'military_branch_id', 'id');
    }

    //General Functions
    public function isAdmin()
    {
        $roles = $this->roles->pluck('title')->toArray();

        return in_array('ADMINISTRADOR', $roles);
    }


}
