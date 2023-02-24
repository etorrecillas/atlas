<?php

namespace App\Observers;

use App\Models\MilitaryBranch;
use App\Models\MilitaryOrganization;
use App\Models\Ranking;
use App\Models\RoleUser;
use App\Models\Specialty;
use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $admin = Auth::user();

        SystemLog::create([
            'message' => $admin->ranking->short . ' ' . $admin->name . ' cadastrou o usuário: ' . $user->email,
        ]);

    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $admin = Auth::user();

        $changeStr = '';

        $mapping = [
            'name' => 'Nome',
            'ranking_id' => 'Posto/Graduação',
            'military_branch_id' => 'Quadro',
            'specialty_id' => 'Especialidade',
            'military_organization_id' => 'OM',
            'email' => 'Email',
            'password' => 'Senha',
        ];

        foreach ($user->getChanges() as $key => $value) {
            if ($key == 'updated_at') {
                unset($user->getChanges()[$key]);
            }
            elseif ($key == 'ranking_id') {
                $changeStr.= $mapping[$key] . ': ' . Ranking::where('id',$user->getOriginal($key))->first()->short . ' => ' . Ranking::where('id',$value)->first()->short . '; ';
            }
            elseif ($key == 'military_branch_id') {
                $changeStr.= $mapping[$key] . ': ' . MilitaryBranch::where('id',$user->getOriginal($key))->first()->short . ' => ' . MilitaryBranch::where('id',$value)->first()->short . '; ';
            }
            elseif ($key == 'specialty_id') {
                $changeStr.= $mapping[$key] . ': ' . Specialty::where('id',$user->getOriginal($key))->first()->short . ' => ' . Specialty::where('id',$value)->first()->short . '; ';
            }
            elseif ($key == 'military_organization_id') {
                $changeStr.= $mapping[$key] . ': ' . MilitaryOrganization::where('id',$user->getOriginal($key))->first()->short . ' => ' . MilitaryOrganization::where('id',$value)->first()->short . '; ';
            }
            elseif ($key == 'email') {
                $changeStr.= $mapping[$key] . ': ' . $user->getOriginal($key) . ' => ' . $value. '; ';
            }
            elseif ($key == 'name') {
                $changeStr.= $mapping[$key] . ': ' . $user->getOriginal($key) . ' => ' . $value. '; ';
            }
            elseif ($key == 'password' && $admin->id!=$user->id) {
                $changeStr.= $mapping[$key] . ' redefinida; ';
            }
        }

        $changeStr = trim($changeStr, '; ');

        if($changeStr != '') {
            SystemLog::create([
                'message' => $admin->ranking->short . ' ' . $admin->name . ' atualizou o usuário: ' . $user->getOriginal('email').'. ***Alterações: '.$changeStr,
            ]);
        }

    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $admin = Auth::user();

        SystemLog::create([
                'message' => $admin->ranking->short . ' ' . $admin->name . ' removeu o usuário: ' . $user->email,
        ]);
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
