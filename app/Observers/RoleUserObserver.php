<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleUserObserver
{
    /**
     * Handle the role user "created" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function created(RoleUser $roleUser)
    {
        $admin = Auth::user();

        $role = Role::where('id', $roleUser->role_id)->first();
        $user = User::where('id', $roleUser->user_id)->first();

        SystemLog::create([
            'message' => $admin->ranking->short. ' '.$admin->name.' atribuiu perfil de ' .$role->title. ' ao usuário '. $user->email,
        ]);

    }

    /**
     * Handle the role user "updated" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function updated(RoleUser $roleUser)
    {
        //
    }

    /**
     * Handle the role user "deleted" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function deleted(RoleUser $roleUser)
    {
        //
    }

    /**
     * Handle the role user "restored" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function restored(RoleUser $roleUser)
    {
        //
    }

    /**
     * Handle the role user "force deleted" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function forceDeleted(RoleUser $roleUser)
    {
        //
    }
}
