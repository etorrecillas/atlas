<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\MilitaryOrganization;
use App\Models\SystemLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ActivityObserver
{
    /**
     * Handle the activity "created" event.
     *
     * @param  \App\Models\Activity  $activity
     * @return void
     */
    public function created(Activity $activity)
    {
        $user = Auth::user();

        $messageStr = isset($activity->type->short) ? $activity->type->short." ".$activity->title : $activity->type->title." ".$activity->title;

        SystemLog::create([
            'message' => $user->ranking->short . ' ' . $user->name . ' criou a atividade: ' . $messageStr . ' para a OM ' . $activity->militaryOrganization->short,
        ]);

    }

    /**
     * Handle the activity "updated" event.
     *
     * @param  \App\Models\Activity  $activity
     * @return void
     */
    public function updated(Activity $activity)
    {
        $admin = Auth::user();

        $changeStr = '';

        $mapping = [
            'activity_type_id' => 'Tipo de atividade',
            'military_organization_id' => 'OM',
            'title' => 'Título',
            'finished_date' => 'Data de conclusão',
            'reference_number' => 'Número',
            'comments' => 'Observações',
            'value_in_cents' => 'Valor',
        ];

        foreach ($activity->getChanges() as $key => $value) {
            if ($key == 'updated_at') {
                unset($activity->getChanges()[$key]);
            }
            elseif ($key == 'activity_type_id') {
                if($activity->getOriginal($key) == null)
                    $changeStr.= $mapping[$key] . ': Sem tipo => ' . ActivityType::where('id',$value)->first()->title . '; ';
                else
                    $changeStr.= $mapping[$key] . ': ' . ActivityType::where('id',$activity->getOriginal($key))->first()->title . ' => ' . ActivityType::where('id',$value)->first()->title . '; ';
            }
            elseif ($key == 'military_organization_id') {
                if($activity->getOriginal($key) == null)
                    $changeStr.= $mapping[$key] . ': Sem OM => ' . MilitaryOrganization::where('id',$value)->first()->short . '; ';
                else
                    $changeStr.= $mapping[$key] . ': ' . MilitaryOrganization::where('id',$activity->getOriginal($key))->first()->short . ' => ' . MilitaryOrganization::where('id',$value)->first()->short . '; ';
            }
            elseif ($key == 'title') {
                $changeStr.= $mapping[$key] . ': ' . $activity->getOriginal($key) . ' => ' . $value. '; ';
            }
            elseif ($key == 'finished_date') {

                $prev = $activity->getOriginal($key)->format('d/m/Y');
                $new = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y');

                $changeStr.= $mapping[$key] . ': ' . $prev . ' => ' . $new . '; ';
            }
            elseif ($key == 'reference_number') {
                $changeStr.= $mapping[$key] . ': ' . $activity->getOriginal($key) . ' => ' . $value. '; ';
            }
            elseif ($key == 'comments') {
                $changeStr.= $mapping[$key] . ': ' . $activity->getOriginal($key) . ' => ' . $value. '; ';
            }
            elseif ($key == 'value_in_cents') {
                if($activity->getOriginal($key) === null) {
                    $prev = 'N/A';
                } else {
                    $prev = 'R$ '.number_format($activity->getOriginal($key)/100, 2, ',', '.');
                }

                if($value === null) {
                    $new = 'N/A';
                } else {
                    $new = 'R$ '.number_format($value/100, 2, ',', '.');
                }

                if($prev != $new) {
                    $changeStr.= $mapping[$key] . ': ' . $prev . ' => ' . $new . '; ';
                }
            }
        }

        $changeStr = trim($changeStr, '; ');

        if($changeStr != '') {
            SystemLog::create([
                'message' => $admin->ranking->short . ' ' . $admin->name . ' atualizou a atividade: ' . $activity->getOriginal('title').'. ***Alterações: '.$changeStr,
            ]);
        }
    }

    /**
     * Handle the activity "deleted" event.
     *
     * @param  \App\Models\Activity  $activity
     * @return void
     */
    public function deleted(Activity $activity)
    {
        $user = Auth::user();

        $messageStr = isset($activity->type->short) ? $activity->type->short." ".$activity->title : $activity->type->title." ".$activity->title;

        SystemLog::create([
            'message' => $user->ranking->short . ' ' . $user->name . ' apagou a atividade: ' . $messageStr . ' da OM ' . $activity->militaryOrganization->short,
        ]);

    }

    /**
     * Handle the activity "restored" event.
     *
     * @param  \App\Models\Activity  $activity
     * @return void
     */
    public function restored(Activity $activity)
    {
        //
    }

    /**
     * Handle the activity "force deleted" event.
     *
     * @param  \App\Models\Activity  $activity
     * @return void
     */
    public function forceDeleted(Activity $activity)
    {
        //
    }
}
