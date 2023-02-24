@extends('layout.dashboard.index')

@section('page_title', 'Administração | Usuários | Cadastrar Novo Usuário')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">add</i>
                    </div>
                    <h4 class="card-title">Cadastrar novo usuário</h4>
                </div>
                <div class="card-body ">

                    <div class="container">
                        <div class="tab-content tab-space">
                            <form id="userCreate" action="{{ route('admin.usuarios.store') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Nome de Guerra*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('name') is-focused @enderror">
                                            <input value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') error @enderror" required aria-required="true">
                                            <span class="bmd-help">Ex.: SOUZA SILVA</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Posto/Graduação*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="dropdown bootstrap-select form-group" style="margin-top: 0px;">
                                            <select name="ranking_id" class="selectpicker" data-style="select-with-transition" title="Selecionar" data-size="7" data-live-search="true" required aria-required="true">
                                                @foreach($rankings as $ranking)
                                                    <option value="{{ $ranking->id }}" {{ old('ranking_id') == $ranking->id ? "selected" : ""}}>{{ $ranking->short }} ({{ $ranking->title }}) </option>
                                                @endforeach
                                            </select>
                                            @error('ranking_id')<label style="margin-top: 50px; width: 300px;" id="email-error" class="error" for="code">{{ $message }}</label>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Quadro*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="dropdown bootstrap-select form-group" style="margin-top: 0px;">
                                            <select name="military_branch_id" class="selectpicker" data-style="select-with-transition" title="Selecionar" data-size="7" data-live-search="true" required aria-required="true">
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{ old('military_branch_id') == $branch->id ? "selected" : ""}}>{{ $branch->short }} ({{ $branch->title }}) </option>
                                                @endforeach
                                            </select>
                                            @error('military_branch_id')<label style="margin-top: 50px; width: 300px;" id="email-error" class="error" for="code">{{ $message }}</label>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Especialidade*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="dropdown bootstrap-select form-group" style="margin-top: 0px;">
                                            <select name="specialty_id" class="selectpicker" data-style="select-with-transition" title="Selecionar" data-size="7" data-live-search="true" required aria-required="true">
                                                @foreach($specialties as $specialty)
                                                    <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? "selected" : ""}}>{{ $specialty->short }} ({{ $specialty->title }}) </option>
                                                @endforeach
                                            </select>
                                            @error('specialty_id')<label style="margin-top: 50px; width: 300px;" id="email-error" class="error" for="code">{{ $message }}</label>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">OM*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="dropdown bootstrap-select form-group" style="margin-top: 0px;">
                                            <select name="military_organization_id" class="selectpicker" data-style="select-with-transition" title="Selecionar" data-size="7" data-live-search="true" required aria-required="true">
                                                @foreach($militaryOrg as $om)
                                                    <option value="{{ $om->id }}" {{ old('military_organization_id') == $om->id ? "selected" : ""}}>{{ $om->short }} ({{ $om->title }}) </option>
                                                @endforeach
                                            </select>
                                            @error('military_organization_id')<label style="margin-top: 50px; width: 300px;" id="email-error" class="error" for="code">{{ $message }}</label>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Email*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('email') is-focused @enderror">
                                            <input value="{{ old('email') }}" name="email" type="email" class="form-control @error('email') error @enderror" required aria-required="true" required aria-required="true">
                                            <span class="bmd-help">Ex.: souzasilvajssc@fab.mil.br</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Acesso*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="dropdown bootstrap-select form-group" style="margin-top: 0px;">
                                            <select name="role_id" class="selectpicker" data-style="select-with-transition" title="Selecionar" data-size="7" required aria-required="true">
                                                @if (old('role_id') == 1)
                                                    <option value="2">USUÁRIO</option>
                                                    <option value="1" selected>ADMINISTRADOR</option>
                                                @else
                                                    <option value="2" selected>USUÁRIO</option>
                                                    <option value="1">ADMINISTRADOR</option>
                                                @endif
                                            </select>
                                            @error('role_id')<label id="email-error" class="error" for="code">{{ $message }}</label>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-md-2">
                                    </div>
                                    <div class="col-sm-9 col-md-10">
                                        <h8>Campos marcados com * são de preenchimento obrigatório</h8>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-md-2">
                                    </div>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary pull-left" type="submit">Cadastrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-primary pull-left">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('extra_script')
    <script>
        $(document).ready(function() {
            $("#userCreate").validate({
                messages: {
                    name: "Informe o nome de guerra",
                    ranking_id: "Selecione o posto/graduação",
                    military_branch_id: "Selecione o quadro",
                    specialty_id: "Selecione a especialidade",
                    military_organization_id: "Selecione a OM",
                    email: "Informe o email",
                    role_id: "Selecione o acesso",
                }
            });
        });

    </script>

@endpush
