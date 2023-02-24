<?php

namespace App\Observers;

use App\Models\ActivityType;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

class ActivityTypeObserver
{
    /**
     * Handle the activity type "created" event.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return void
     */
    public function created(ActivityType $activityType)
    {
        $user = Auth::user();

        $messageStr = isset($activityType->short) ? $activityType->short : $activityType->title;

        SystemLog::create([
            'message' => $user->ranking->short . ' ' . $user->name . ' criou o tipo de atividade: ' . $messageStr,
        ]);

    }

    /**
     * Handle the activity type "updated" event.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return void
     */
    public function updated(ActivityType $activityType)
    {
        $user = Auth::user();

        $changeStr = '';

        $mapping = [
            'title' => 'Tipo',
            'short' => 'Sigla',
        ];

        foreach ($activityType->getChanges() as $key => $value) {
            if ($key == 'updated_at') {
                unset($activityType->getChanges()[$key]);
            }
            else {
                $changeStr.= $mapping[$key] . ': ' . $activityType->getOriginal()[$key] . ' => ' . $value . '; ';
            }
        }

        $changeStr = trim($changeStr, '; ');

        $short = $activityType->getOriginal('short');

        $messageStr = isset($short) ? $short : $activityType->getOriginal('title');

        if($changeStr != '') {
            SystemLog::create([
                'message' => $user->ranking->short . ' ' . $user->name . ' atualizou o tipo de atividade: ' . $messageStr .'. ***Alterações: '.$changeStr,
            ]);
        }



    }

    /**
     * Handle the activity type "deleted" event.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return void
     */
    public function deleted(ActivityType $activityType)
    {
        $user = Auth::user();

        $messageStr = isset($activityType->short) ? $activityType->short : $activityType->title;

        SystemLog::create([
            'message' => $user->ranking->short . ' ' . $user->name . ' removeu o tipo de atividade: ' . $messageStr,
        ]);

    }

    /**
     * Handle the activity type "restored" event.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return void
     */
    public function restored(ActivityType $activityType)
    {
        //
    }

    /**
     * Handle the activity type "force deleted" event.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return void
     */
    public function forceDeleted(ActivityType $activityType)
    {
        //
    }
}
