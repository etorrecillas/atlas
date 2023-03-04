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
        $sectors = [
            'SDA',
            'SDE',
            'SDP',
        ];

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
        foreach($sectors as $sector) {

            $label = $sector;
            $numbers = [];
            foreach ($allOm as $om) {
                if($om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->whereNotNull('sector')->count() == 0)
                    $atvSectorOm = 0;
                else
                    $atvSectorOm = 100*$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector', $sector)->count()/$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->count();
                $numbers[] = $atvSectorOm;
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

        //Grafico 3
        $chart['chart3'] = [
            'labels' => [],
            'totals' => [],
        ];

        foreach ($allOm as $om) {
            $chart['chart3']['labels'][] = $om->short;
            $chart['chart3']['totals'][] = $om->activities
                ->where('finished_date', '>=', $from)
                ->where('finished_date', '<=', $to)
                ->where('sector','SDA')
                ->count();
        }


        //Grafico 4
        $datasets = [];
        foreach($types as $type) {

            $label = $type->title;
            $numbers = [];
            foreach ($allOm as $om) {
                if($om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDA')->count() == 0)
                    $atvTypeOm = 0;
                else
                    $atvTypeOm = 100*$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDA')->where('activity_type_id', $type->id)->count()/$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDA')->count();
                $numbers[] = $atvTypeOm;
            }

            $datasets[] = [
                'label' => $label,
                'data' => $numbers,
                'borderWidth' => 1
            ];
        }

        $chart['chart4'] = [
            'labels' => $chart['chart1']['labels'],
            'datasets' => $datasets,
        ];

        //Grafico 5
        $chart['chart5'] = [
            'labels' => [],
            'totals' => [],
        ];

        foreach ($allOm as $om) {
            $chart['chart5']['labels'][] = $om->short;
            $chart['chart5']['totals'][] = $om->activities
                ->where('finished_date', '>=', $from)
                ->where('finished_date', '<=', $to)
                ->where('sector','SDE')
                ->count();
        }


        //Grafico 6
        $datasets = [];
        foreach($types as $type) {

            $label = $type->title;
            $numbers = [];
            foreach ($allOm as $om) {
                if($om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDE')->count() == 0)
                    $atvTypeOm = 0;
                else
                    $atvTypeOm = 100*$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDE')->where('activity_type_id', $type->id)->count()/$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDE')->count();
                $numbers[] = $atvTypeOm;
            }

            $datasets[] = [
                'label' => $label,
                'data' => $numbers,
                'borderWidth' => 1
            ];
        }

        $chart['chart6'] = [
            'labels' => $chart['chart1']['labels'],
            'datasets' => $datasets,
        ];

        //Grafico 7
        $chart['chart7'] = [
            'labels' => [],
            'totals' => [],
        ];

        foreach ($allOm as $om) {
            $chart['chart7']['labels'][] = $om->short;
            $chart['chart7']['totals'][] = $om->activities
                ->where('finished_date', '>=', $from)
                ->where('finished_date', '<=', $to)
                ->where('sector','SDP')
                ->count();
        }


        //Grafico 8
        $datasets = [];
        foreach($types as $type) {

            $label = $type->title;
            $numbers = [];
            foreach ($allOm as $om) {
                if($om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDP')->count() == 0)
                    $atvTypeOm = 0;
                else
                    $atvTypeOm = 100*$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDP')->where('activity_type_id', $type->id)->count()/$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector','SDP')->count();
                $numbers[] = $atvTypeOm;
            }

            $datasets[] = [
                'label' => $label,
                'data' => $numbers,
                'borderWidth' => 1
            ];
        }

        $chart['chart8'] = [
            'labels' => $chart['chart1']['labels'],
            'datasets' => $datasets,
        ];




//
//
//        foreach($types as $type) {
//
//            $label = $sector;
//            $numbers = [];
//            foreach ($allOm as $om) {
//                if($om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->whereNotNull('sector')->count() == 0)
//                    $atvSectorOm = 0;
//                else
//                    $atvSectorOm = 100*$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->where('sector', $sector)->count()/$om->activities->where('finished_date', '>=', $from)->where('finished_date', '<=', $to)->count();
//                $numbers[] = $atvSectorOm;
//            }
//
//            $datasets[] = [
//                'label' => $label,
//                'data' => $numbers,
//                'borderWidth' => 1
//            ];
//        }
//
//        $chart['chart2'] = [
//            'labels' => $chart['chart1']['labels'],
//            'datasets' => $datasets,
//        ];


        $response = $chart;

        return json_encode($response);
    }



}
