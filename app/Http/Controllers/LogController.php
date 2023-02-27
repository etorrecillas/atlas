<?php

namespace App\Http\Controllers;

use App\Models\SystemLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
//        $allLogs = SystemLog::orderBy('created_at', 'desc')->get();

//        return view('dashboard.admin.system_logs.index', compact('allLogs'));
        return view('dashboard.admin.system_logs.index');
    }

    public function indexAjax()
    {
        $list = SystemLog::orderBy('created_at', 'desc')->get();

        return datatables($list)->toJson();

    }
}
