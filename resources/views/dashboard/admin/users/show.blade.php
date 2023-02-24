@extends('layout.dashboard.index')

@section('page_title', 'Administração | Usuários | '. $user->ranking->short . ' ' . $user->name)

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">visibility</i>
                    </div>
                    <h4 class="card-title">{{ $user->ranking->short . ' ' . $user->name }}</h4>
                </div>
                <div class="card-body ">

                    <div class="container">
                        <div class="tab-content tab-space">
                            <div class="row">
                                <label class="col-md-3 col-form-label">Nome de Guerra</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Posto/Graduação</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $user->ranking->short }} ({{ $user->ranking->title }})</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Quadro</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $user->branch->short }} ({{ $user->branch->title }})</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Especialidade</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $user->specialty->short }} ({{ $user->specialty->title }})</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">OM</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        @if(isset($user->militaryOrg->short))
                                            <p>{{ $user->militaryOrg->short }} ({{ $user->militaryOrg->title }})</p>
                                        @else
                                            <p>Usuário não vinculado a uma OM</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Email</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Acesso</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $user->roles->first()->title }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Senha</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <a href="javascript();"><span class="badge badge-primary reset-pass">Redefinir</span></a>
                                        <form action="{{ route('admin.usuarios.resetpass', $user) }}" method="post" id="reset-pass">@csrf</form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn btn-sm btn-primary">Editar Usuário</a>
                            </div>
                        </div>
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


@endsection

@push('extra_script')
    <script>

        $(document).ready(function () {
            $(".reset-pass").click(function (e) {
                e.preventDefault();
                swal({
                    title: 'Você tem certeza?',
                    type: 'warning',
                    text: 'A senha do usuário será alterada para {{ env('DEFAULT_PASSWORD') }}',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Sim, redefinir!',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function(confirm) {
                    if(confirm.value)
                    {
                        $('#reset-pass').submit();
                    }
                });

            });

        });
    </script>
@endpush
