<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $service = new DashboardService();
        $cards = $service->cards();

        return view('dashboard.home', compact('cards'));
    }

    public function ajaxChart(Request $request)
    {
        $request->validate([
            'dateStart' => 'required|date_format:d/m/Y',
            'dateEnd' => 'required|date_format:d/m/Y|after_or_equal:dateStart',
        ]);

        if(isset($request->dateStart)) {
            $request->from = Carbon::createFromFormat('d/m/Y', $request->dateStart)->format('Y-m-d');
        }

        if(isset($request->dateEnd)) {
            $request->to = Carbon::createFromFormat('d/m/Y', $request->dateEnd)->format('Y-m-d');
        }

        $service = new DashboardService();
        $chart = $service->charts($request->from, $request->to);

        return $chart;
    }
}
