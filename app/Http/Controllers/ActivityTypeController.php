<?php

namespace App\Http\Controllers;

use App\Models\ActivityType;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTypes = ActivityType::orderBy('title')->get();

        return view('dashboard.admin.activity_types.index', compact('allTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.activity_types.create');
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
            'type' => 'required|string|max:255|unique:activity_types,title',
            'short' => 'nullable|string|max:255|unique:activity_types,short',
        ]);

        $request->merge([
            'title' => $request->type,
        ]);

        try {
            $activityType = ActivityType::create($request->except(['type']));

            return redirect(route('admin.tipos_atividade.index'))->with('msg-success', 'Tipo de atividade ' . $request->title . ' criado com sucesso.');
        } catch (\Exception $e) {

            if (config('app.debug')) {
                return redirect(route('admin.tipos_atividade.index'))->with('msg-danger', 'Erro: ' . $e->getMessage());
            }
            return redirect(route('admin.tipos_atividade.index'))->with('msg-danger', 'Erro ao criar o tipo de atividade ' . $request->title);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityType $activityType)
    {
        $activityType->load('activities')->get();

        return view('dashboard.admin.activity_types.show', compact('activityType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityType $activityType)
    {
        return view('dashboard.admin.activity_types.edit', compact('activityType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityType $activityType)
    {
        $request->validate([
            'short' => 'nullable|unique:activity_types,short,'.$activityType->id,
            'type' => 'required|unique:activity_types,title,'.$activityType->id,
        ]);

        $request->merge([
            'title' => $request->type,
        ]);

        try {

            $activityType->short = $request->short;
            $activityType->title = $request->title;
            $activityType->save();

            return redirect(route('admin.tipos_atividade.index'))->with('msg-success', 'Tipo de Atividade '. $activityType->title .' atualizado com sucesso');

        } catch (\Exception $e) {
            if(config('app.debug')) {
                return back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return back()->with('msg-danger','Não foi possível atualizar o tipo de atividade '.$activityType->title.'. Tente novamente mais tarde.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityType  $activityType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityType $activityType)
    {
        try {
            $activityType->delete();
            return redirect(route('admin.tipos_atividade.index'))->with('msg-success', 'Tipo de atividade '. $activityType->title .' removido com sucesso');
        } catch (\Exception $e) {

            if(config('app.debug')) {
                return redirect(route('admin.tipos_atividade.index'))->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect(route('admin.tipos_atividade.index'))->with('msg-danger','Erro ao remover o tipo de atividade '. $activityType->title);


        }

    }
}
