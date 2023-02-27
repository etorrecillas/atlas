<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\MilitaryOrganization;
use App\Models\User;

class DashboardService {

    public function cards()
    {
        $atv = Activity::count();
        $yearAtv = Activity::whereYear('finished_date', date('Y'))->count();
        $om = MilitaryOrganization::count();
        $users = User::count();

        $cards = [
            'atv' => $atv,
            'yearAtv' => $yearAtv,
            'om' => $om,
            'users' => $users,
        ];

        return $cards;

    }

    public function charts($from, $to)
    {
        $allOm = MilitaryOrganization::orderBy('short')->get();
        $types = ActivityType::orderBy('title')->get();

        //Grafico 1
        $chart['chart1'] = [
            'labels' => [],
            'totals' => [],
        ];

        foreach ($allOm as $om) {
            $chart['chart1']['labels'][] = $om->short;
            $chart['chart1']['totals'][] = $om->activities
                ->where('finished_date', '>=', $from)
                ->where('finished_date', '<=', $to)
                ->count();
        }

        //Grafico 2
        $datasets = [];
        foreach($types as $type) {

            $label = $type->title;
            $numbers = [];
            foreach ($allOm as $om) {
                if($om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->count() == 0)
                    $atvTypeOm = 0;
                else
                    $atvTypeOm = 100*$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('activity_type_id', $type->id)->count()/$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->count();
                $numbers[] = $atvTypeOm;
            }

            $datasets[] = [
                'label' => $label,
                'data' => $numbers,
                'borderWidth' => 1
            ];
        }

        $chart['chart2'] = [
            'labels' => $chart['chart1']['labels'],
            'datasets' => $datasets,
        ];

        $response = $chart;

        return json_encode($response);
    }



}
