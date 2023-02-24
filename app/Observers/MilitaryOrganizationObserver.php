<?php

namespace App\Observers;

use App\Models\MilitaryOrganization;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

class MilitaryOrganizationObserver
{
    /**
     * Handle the military organization "created" event.
     *
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return void
     */
    public function created(MilitaryOrganization $militaryOrganization)
    {
        $user = Auth::user();

        SystemLog::create([
            'message' => $user->ranking->short . ' ' . $user->name . ' criou a OM: ' . $militaryOrganization->short,
        ]);
    }

    /**
     * Handle the military organization "updated" event.
     *
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return void
     */
    public function updated(MilitaryOrganization $militaryOrganization)
    {
        $user = Auth::user();

        $changeStr = '';

        $mapping = [
            'title' => 'Nome',
            'short' => 'Sigla',
        ];

        foreach ($militaryOrganization->getChanges() as $key => $value) {
            if ($key == 'updated_at') {
                unset($militaryOrganization->getChanges()[$key]);
            }
            else {
                $changeStr.= $mapping[$key] . ': ' . $militaryOrganization->getOriginal()[$key] . ' => ' . $value . '; ';
            }
        }

        $changeStr = trim($changeStr, '; ');

        if($changeStr != '') {
            SystemLog::create([
                'message' => $user->ranking->short . ' ' . $user->name . ' atualizou a OM: ' . $militaryOrganization->getOriginal('short').'. ***Alterações: '.$changeStr,
            ]);
        }



    }

    /**
     * Handle the military organization "deleted" event.
     *
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return void
     */
    public function deleted(MilitaryOrganization $militaryOrganization)
    {
        $user = Auth::user();

        SystemLog::create([
            'message' => $user->ranking->short . ' ' . $user->name . ' removeu a OM: ' . $militaryOrganization->short,
        ]);

    }

    /**
     * Handle the military organization "restored" event.
     *
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return void
     */
    public function restored(MilitaryOrganization $militaryOrganization)
    {
        //
    }

    /**
     * Handle the military organization "force deleted" event.
     *
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return void
     */
    public function forceDeleted(MilitaryOrganization $militaryOrganization)
    {
        //
    }
}
