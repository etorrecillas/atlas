<?php

namespace App\Http\Controllers;

use App\Models\MilitaryBranch;
use App\Models\MilitaryOrganization;
use App\Models\Specialty;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $MilitaryBranches = MilitaryBranch::orderBy('short')->get();

        echo "Lista de Quadro Cadastrados<br>";
        echo "====================================<br>";

        foreach ($MilitaryBranches as $MilitaryBranch) {
            echo $MilitaryBranch->short." - ".$MilitaryBranch->title."<br>";
        }

        $Specialties = Specialty::orderBy('short')->get();

        echo "<br><br>Lista de Especialidades Cadastradas<br>";
        echo "====================================<br>";

        foreach ($Specialties as $Specialty) {
            echo $Specialty->short." - ".$Specialty->title."<br>";
        }
    }
}
