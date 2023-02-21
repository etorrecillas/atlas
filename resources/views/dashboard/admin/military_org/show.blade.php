@extends('layout.dashboard.index')

@section('page_title', 'Administração | Organizações Militares | '. $militaryOrganization->short)

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">visibility</i>
                    </div>
                    <h4 class="card-title">{{ $militaryOrganization->short }}</h4>
                </div>
                <div class="card-body ">

                    <div class="container">
                        <div class="tab-content tab-space">
                            <div class="row">
                                <label class="col-md-3 col-form-label">Sigla</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $militaryOrganization->short }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Nome</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $militaryOrganization->title }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Usuários</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        @foreach($militaryOrganization->users() as $user)
                                            <a href=""><span class="badge badge-primary">{{ $user->ranking->short }} {{ $user->name }}</span></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                &nbsp;
                            </div>
                        </div>

                        <div class="row">
{{--                            <div class="table-responsive table-striped">--}}
{{--                                <table id="datatable_om" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th data-priority="1">Sigla</th>--}}
{{--                                        <th data-priority="2">Nome</th>--}}
{{--                                        <th data-priority="3">Atividades</th>--}}
{{--                                        <th data-priority="4">Usuários</th>--}}
{{--                                        <th data-priority="5" data-orderable="false" class="disabled-sorting text-right">Detalhes</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tfoot>--}}
{{--                                    <tr>--}}
{{--                                        <th>Sigla</th>--}}
{{--                                        <th>Nome</th>--}}
{{--                                        <th>Atividades</th>--}}
{{--                                        <th>Usuários</th>--}}
{{--                                        <th data-orderable="false" class="disabled-sorting text-right">Detalhes</th>--}}
{{--                                    </tr>--}}
{{--                                    </tfoot>--}}
{{--                                    <tbody>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('admin.om.index') }}" class="btn btn-primary pull-left">Voltar</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
