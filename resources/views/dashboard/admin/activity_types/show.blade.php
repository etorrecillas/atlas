@extends('layout.dashboard.index')

@section('page_title')
    Administração | Tipos de Atividade | {{ isset($activityType->short) ? $activityType->short : $activityType->title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">visibility</i>
                    </div>
                    <h4 class="card-title">{{ isset($activityType->short) ? $activityType->short : $activityType->title }}</h4>
                </div>
                <div class="card-body ">

                    <div class="container">
                        <div class="tab-content tab-space">
                            <div class="row">
                                <label class="col-md-3 col-form-label">Sigla</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{!! isset($activityType->short) ? $activityType->short : '&nbsp;' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Nome</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $activityType->title }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Atividades</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $activityType->activities->count() }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                        </div>

{{--                        @if($militaryOrganization->activities_count > 0)--}}
{{--                        <hr>--}}
{{--                        <div class="row">--}}
{{--                            Lista de atividades cadastradas com tipo {{ isset($activityType->short) ? $activityType->short : $activityType->title }}--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="table-responsive table-striped">--}}
{{--                                <table id="datatable_type" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th data-priority="1">OM</th>--}}
{{--                                        <th data-priority="2">Título</th>--}}
{{--                                        <th data-priority="3">Data Conclusão</th>--}}
{{--                                        <th data-priority="4">Ref.</th>--}}
{{--                                        <th data-priority="5">Valor</th>--}}
{{--                                        <th data-priority="6" data-orderable="false" class="disabled-sorting text-right">Ações</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tfoot>--}}
{{--                                    <tr>--}}
{{--                                        <th>OM</th>--}}
{{--                                        <th>Título</th>--}}
{{--                                        <th>Data Conclusão</th>--}}
{{--                                        <th>Ref.</th>--}}
{{--                                        <th>Valor</th>--}}
{{--                                        <th data-orderable="false" class="disabled-sorting text-right">Ações</th>--}}
{{--                                    </tr>--}}
{{--                                    </tfoot>--}}
{{--                                    <tbody>--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                        <hr>--}}
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('admin.tipos_atividade.edit', $activityType) }}" class="btn btn-sm btn-primary">Editar Tipo de Atividade</a>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('admin.tipos_atividade.index') }}" class="btn btn-primary pull-left">Voltar</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
