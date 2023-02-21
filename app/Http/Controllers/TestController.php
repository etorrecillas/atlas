<?php

namespace App\Http\Controllers;

use App\Models\MilitaryOrganization;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $om = MilitaryOrganization::where('id', 1)
            ->first();

        foreach ($om->users() as $user) {
            dump($user->ranking->short." ".$user->name);
        }

    }
}
