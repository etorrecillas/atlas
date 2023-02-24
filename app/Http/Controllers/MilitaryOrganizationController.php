<?php

namespace App\Http\Controllers;

use App\Models\MilitaryOrganization;
use Illuminate\Http\Request;

class MilitaryOrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allOm = MilitaryOrganization::orderBy('short')
            ->with('activities')
            ->get();
        return view('dashboard.admin.military_org.index', compact('allOm'));
    }

//    public function indexAjax()
//    {
//        $om = MilitaryOrganization::orderBy('short')
//            ->get();
//
//        return datatables($om)->toJson();
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.military_org.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'short' => 'required|unique:military_organizations,short',
            'name' => 'required|unique:military_organizations,title',
        ]);

        try {
            $newOm = MilitaryOrganization::create([
                'short' => $request->short,
                'title' => $request->name,
            ]);

            return redirect(route('admin.om.index'))->with('msg-success', 'OM '. $newOm->short .' cadastrada com sucesso.');
        } catch (\Exception $e) {
            if(config('app.debug')) {
                return back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return back()->with('msg-danger','Não foi possível cadastrar a OM '.$request->short.'. Tente novamente mais tarde.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return \Illuminate\Http\Response
     */
    public function show(MilitaryOrganization $militaryOrganization)
    {


        return view('dashboard.admin.military_org.show', compact('militaryOrganization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return \Illuminate\Http\Response
     */
    public function edit(MilitaryOrganization $militaryOrganization)
    {
        return view('dashboard.admin.military_org.edit', compact('militaryOrganization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MilitaryOrganization $militaryOrganization)
    {
        $request->validate([
            'short' => 'required|unique:military_organizations,short,'.$militaryOrganization->id,
            'name' => 'required|unique:military_organizations,title,'.$militaryOrganization->id,
        ]);


        try {

            $militaryOrganization->short = $request->short;
            $militaryOrganization->title = $request->name;
            $militaryOrganization->save();

            return redirect(route('admin.om.index'))->with('msg-success', 'Organização militar '. $militaryOrganization->short .' atualizada com sucesso');

        } catch (\Exception $e) {
            if(config('app.debug')) {
                return back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return back()->with('msg-danger','Não foi possível atualizar a OM '.$militaryOrganization->short.'. Tente novamente mais tarde.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MilitaryOrganization  $militaryOrganization
     * @return \Illuminate\Http\Response
     */
    public function destroy(MilitaryOrganization $militaryOrganization)
    {
        try {
            $militaryOrganization->delete();
            return redirect(route('admin.om.index'))->with('msg-success', 'Organização militar '. $militaryOrganization->short .' removida com sucesso');
        } catch (\Exception $e) {

            if(config('app.debug')) {
                return redirect(route('admin.om.index'))->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect(route('admin.om.index'))->with('msg-danger','Erro ao remover a organização militar '. $militaryOrganization->short);


        }
    }
}
