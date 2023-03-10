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
        if(isset($request->name)) {
            $request->name = strtoupper($request->name);
        }

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
            $password = Hash::make('@tlas123');
            $request->merge(['password' => $password]);
            $request->email = strtolower($request->email);
            $request->name = strtoupper($request->name);

            $user = User::create($request->all());
            $user->roles()->attach($request->role_id);
            return redirect(route('admin.usuarios.index'))->with('msg-success', 'Usu??rio ' . $user->email . ' criado com sucesso com a senha padr??o: @tlas123');
        } catch (\Exception $e) {

            if (config('app.debug')) {
                return redirect(route('admin.usuarios.index'))->with('msg-danger', 'Erro: ' . $e->getMessage());
            }
            return redirect(route('admin.usuarios.index'))->with('msg-danger', 'Erro ao criar o usu??rio ' . $request->email);
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

            $request->email = strtolower($request->email);
            $request->name = strtoupper($request->name);
            $user->update($request->all());
            $user->roles()->sync($request->role_id);

            return redirect(route('admin.usuarios.index'))->with('msg-success', 'Usu??rio '. $user->email .' atualizado com sucesso');

        } catch (\Exception $e) {
            if(config('app.debug')) {
                return back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return back()->with('msg-danger','N??o foi poss??vel atualizar o usu??rio '.$user->email.'. Tente novamente mais tarde.');
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
            return redirect(route('admin.usuarios.index'))->with('msg-danger','Voc?? n??o pode remover o seu pr??prio usu??rio');
        }

        try {
            $user->delete();
            return redirect(route('admin.usuarios.index'))->with('msg-success', 'Usu??rio '. $user->email .' removido com sucesso');
        } catch (\Exception $e) {

            if(config('app.debug')) {
                return redirect(route('admin.usuarios.index'))->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect(route('admin.usuarios.index'))->with('msg-danger','Erro ao remover o usu??rio '. $user->email);


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
            $hash = Hash::make('@tlas123');
            $user->password = $hash;
            $user->save();

            return redirect()->back()->with('msg-success', 'Senha do usu??rio '. $user->email .' redefinida para @tlas123 com sucesso');
        } catch (\Exception $e) {

            if(config('app.debug')) {
                return redirect()->back()->with('msg-danger','Erro: '.$e->getMessage());
            }
            return redirect()->back()->with('msg-danger','Erro ao redefinir a senha do usu??rio '. $user->email);

        }
    }
}
