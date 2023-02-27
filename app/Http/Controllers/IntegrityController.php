<?php

namespace App\Http\Controllers;

use App\Services\IntegrityService;
use Illuminate\Http\Request;

class IntegrityController extends Controller
{
    public function index()
    {

        $integrityData = new IntegrityService();
        $integrityData = $integrityData->integrityData();

        return view('dashboard.admin.integrity.index', compact('integrityData'));
    }
}
