<?php

namespace App\Http\Controllers;

use App\Models\MilitaryBranch;
use App\Models\MilitaryOrganization;
use App\Models\Ranking;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = User::with([
            'roles',
            'militaryOrg',
            'ranking',
        ])->get();

        return view('dashboard.admin.users.index', compact('allUsers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rankings = Ranking::orderBy('sorting')->get();
        $branches = MilitaryBranch::orderBy('short')->get();
        $specialties = Specialty::orderBy('short')->get();
        $militaryOrg = MilitaryOrganization::orderBy('short')->get();

        return view('dashboard.admin.users.create', compact('rankings', 'branches', 'specialties', 'militaryOrg'));
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
            'name' => 'required|string|max:255',
            'ranking_id' => 'required|integer|exists:rankings,id',
            'military_branch_id' => 'required|integer|exists:military_branches,id',
            'specialty_id' => 'required|integer|exists:specialties,id',
            'military_organization_id' => 'required|integer|exists:military_organizations,id',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        try {
            $password = Hash::make(env('DEFAULT_PASSWORD'));
            $request->merge(['password' => $password]);

            $user = User::create($request->all());
            $user->roles()->attach($request->role_id);
            return redirect(route('admin.usuarios.index'))->with('msg-success', 'Usuário ' . $user->email . ' criado com sucesso com a senha padrão: '.env('DEFAULT_PASSWORD'));
        } catch (\Exception $e) {

            if (config('app.debug')) {
                return redirect(route('admin.usuarios.index'))->with('msg-danger', 'Erro: ' . $e->getMessage());
            }
            return redirect(route('admin.usuarios.index'))->with('msg-danger', 'Erro ao criar o usuário ' . $request->email);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $user = $user->load([
            'roles',
            'militaryOrg',
            'ranking',
            'specialty',
        ]);

        return view('dashboard.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = $user->load([
            'roles',
            'militaryOrg',
            'ranking',
            'specialty',
        ]);

        $rankings = Ranking::orderBy('sorting')->get();
        $branches = MilitaryBranch::orderBy('short')->get();
        $specialties = Specialty::orderBy('short')->get();
        $militaryOrg = MilitaryOrganization::orderBy('short')->get();

        return view('dashboard.admin.users.edit', compact('user', 'rankings', 'branches', 'specialties', 'militaryOrg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'ranking_id' => 'required|integer|exists:rankings,id',
            'military_branch_id' => 'required|integer|exists:military_branches,id',
            'specialty_id' => 'required|integer|exists:specialties,id',
            'military_organization_id' => 'required|integer|exists:military_organizations,id',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role_id' => 'required|integer|exists:roles,id',
        ]);


        try {

            $user->update($request->all());
            $user->roles()->sync($request->role_id);

            return redirect(route('admin.usuarios.index'))->with('msg-success', 'Usuário '. $user->email .' atualizado com sucesso');

        } catch (\Exception $e) {
            if(config('app.debug')) {
                return back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return back()->with('msg-danger','Não foi possível atualizar o usuário '.$user->email.'. Tente novamente mais tarde.');
        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id == auth()->user()->id) {
            return redirect(route('admin.usuarios.index'))->with('msg-danger','Você não pode remover o seu próprio usuário');
        }

        try {
            $user->delete();
            return redirect(route('admin.usuarios.index'))->with('msg-success', 'Usuário '. $user->email .' removido com sucesso');
        } catch (\Exception $e) {

            if(config('app.debug')) {
                return redirect(route('admin.usuarios.index'))->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect(route('admin.usuarios.index'))->with('msg-danger','Erro ao remover o usuário '. $$user->email);


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(User $user)
    {
        try {
            $hash = Hash::make(env('DEFAULT_PASSWORD'));
            $user->password = $hash;
            $user->save();

            return redirect()->back()->with('msg-success', 'Senha do usuário '. $user->email .' redefinida para '.env("DEFAULT_PASSWORD").' com sucesso');
        } catch (\Exception $e) {

            if(config('app.debug')) {
                return redirect()->back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect()->back()->with('msg-danger','Erro ao redefinir a senha do usuário '. $user->email);

        }
    }
}
