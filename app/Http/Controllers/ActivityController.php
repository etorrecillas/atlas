<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\MilitaryOrganization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.activities.index');
    }

    public function indexAjax()
    {
        $list = Activity::with(['type', 'militaryOrganization'])
            ->get();

        return datatables($list)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if(!isset($user->military_organization_id) && !$user->isAdmin()) {
            return redirect()->route('atividades.index')->with('msg-danger', 'Você deve estar vinculado a uma OM para cadastrar uma atividade. Entre em contato com o administrador do sistema.');
        }

        $militaryOrg = MilitaryOrganization::orderBy('short')->get();
        $activityTypes = ActivityType::orderBy('title')->get();

        return view('dashboard.activities.create', compact('militaryOrg', 'activityTypes'));
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
            'finished_date' => 'required|date_format:d/m/Y',
        ]);

        $originalRequest = $request;

        if ($request->finished_date) {
            $data = Carbon::createFromFormat('d/m/Y', $request->finished_date);
            $request->merge([
                'finished_date' => $data->format('Y-m-d'),
            ]);
        }

        if ($request->value) {
            $request->merge([
                'front_value' => $request->value,
            ]);
            $valor_cents = str_replace(['.',',','R$'], '', $request->value);
            $valor_cents = ltrim($valor_cents);
            $request->merge([
                'value' => $valor_cents,
            ]);
        }

        $request->validate([
            'military_organization_id' => 'sometimes|required|integer|exists:military_organizations,id',
            'finished_date' => 'required|date_format:Y-m-d|before_or_equal:today',
            'activity_type_id' => 'required|integer|exists:activity_types,id',
            'reference_number' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'value' => 'nullable|required_unless:not_applicable_value,1|numeric|min:0',
            'comments' => 'nullable|string|max:250',
            'front_value' => 'nullable',
            'sector' => 'required|string|max:3',
        ]);

        try {
            $creator = Auth::user();

            $request->merge([
                'value_in_cents' => $request->value,
            ]);

            if(!isset($request->military_organization_id)) {
                $request->merge([
                    'military_organization_id' => Auth::user()->military_organization_id,
                ]);
            }

            $request->merge([
                'user_name' => $creator->ranking->short." ".$creator->name.' ('.$creator->email.')',
            ]);

            $newActivity = Activity::create($request->all());

            return redirect()->route('atividades.index')->with('msg-success', 'Atividade cadastrada com sucesso!');


        } catch (\Exception $e) {
            if(config('app.debug')) {
                return back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect()->route('atividades.create')->with('msg-danger', 'Erro ao cadastrar atividade. Tente novamente mais tarde.');

        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('dashboard.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $militaryOrg = MilitaryOrganization::orderBy('short')->get();
        $activityTypes = ActivityType::orderBy('title')->get();

        return view('dashboard.activities.edit', compact('activity', 'militaryOrg', 'activityTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'finished_date' => 'required|date_format:d/m/Y',
        ]);

        $originalRequest = $request;

        if ($request->finished_date) {
            $data = Carbon::createFromFormat('d/m/Y', $request->finished_date);
            $request->merge([
                'finished_date' => $data->format('Y-m-d'),
            ]);
        }

        if ($request->value) {
            $request->merge([
                'front_value' => $request->value,
            ]);
            $valor_cents = str_replace(['.',',','R$'], '', $request->value);
            $valor_cents = ltrim($valor_cents);
            $request->merge([
                'value' => $valor_cents,
            ]);
        }

        $request->validate([
            'military_organization_id' => 'sometimes|required|integer|exists:military_organizations,id',
            'finished_date' => 'required|date_format:Y-m-d|before_or_equal:today',
            'activity_type_id' => 'required|integer|exists:activity_types,id',
            'reference_number' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'value' => 'nullable|required_unless:not_applicable_value,1|numeric|min:0',
            'comments' => 'nullable|string|max:250',
            'front_value' => 'nullable',
            'sector' => 'required|string|max:3',
        ]);

        try {

            $request->merge([
                'value_in_cents' => $request->value,
            ]);

            if(Auth::user()->isAdmin() || Auth::user()->militaryOrg->id == $activity->military_organization_id) {
                $activity->update($request->all());

                return redirect()->back()->with('msg-success', 'Atividade atualizada com sucesso!');

            } else {
                return redirect()->back()->with('msg-danger', 'Você não pode atualizar esta atividade.');
            }

        } catch (\Exception $e) {
            if(config('app.debug')) {
                return back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect()->back()->with('msg-danger', 'Erro ao atualizar atividade. Tente novamente mais tarde.');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $user = Auth::user();

        if($user->militaryOrg->id != $activity->military_organization_id && !$user->isAdmin()) {
            return redirect(route('atividades.index'))->with('msg-danger','Você não pode remover esta atividade.');
        }

        try {
            $activity->delete();
            return redirect(route('atividades.index'))->with('msg-success', 'Atividade '. $activity->title .' removida com sucesso');
        } catch (\Exception $e) {

            if(config('app.debug')) {
                return redirect(route('atividades.index'))->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect(route('atividades.index'))->with('msg-danger','Erro ao remover a atividade '. $activity->title);


        }

    }
}
