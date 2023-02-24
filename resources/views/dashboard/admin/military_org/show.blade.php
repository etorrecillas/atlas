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
                                            <a href="{{ route('admin.usuarios.show', $user) }}"><span class="badge badge-primary">{{ $user->ranking->short }} {{ $user->name }}</span></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                &nbsp;
                            </div>
                        </div>

{{--                        @if($militaryOrganization->activities_count > 0)--}}
                        <hr>
                        <div class="row">
                            Lista de atividades cadastradas na OM {{ $militaryOrganization->short }}
                        </div>
                        <div class="row">
                            <div class="table-responsive table-striped">
                                <table id="datatable_om" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th data-priority="1">Referência</th>
                                        <th data-priority="2">Tipo</th>
                                        <th data-priority="3">Título</th>
                                        <th data-priority="4">Data</th>
                                        <th data-priority="5">Valor</th>
                                        <th data-priority="6" data-orderable="false" class="disabled-sorting text-right">Ações</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Referência</th>
                                        <th>Tipo</th>
                                        <th>Título</th>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th data-orderable="false" class="disabled-sorting text-right">Ações</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
{{--                        @endif--}}
                        <hr>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('admin.om.edit', $militaryOrganization) }}" class="btn btn-sm btn-primary">Editar OM</a>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
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

@push('extra_script')
    <script>
        $(document).ready(function () {
            $('#datatable_om').DataTable({
                {{--"processing": true,--}}
                    {{--"ajax": "{{ route('admin.ajax.om.index') }}",--}}
                    {{--"columns": [--}}
                    {{--    {"data": "short"},--}}
                    {{--    {"data": "title"},--}}
                    {{--    {"data": "activities_count"},--}}
                    {{--    {"data": "users_count"},--}}
                    {{--    {"data": ""}--}}
                    {{--],--}}
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },
                "order": [[0, 'asc']],
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                "responsive": true,
                {{--"columnDefs": [{--}}
                {{--    targets: -1,--}}
                {{--    render: function (data, type, row) {--}}

                {{--        console.log(row);--}}

                {{--        return '<div class="td-actions text-right justify-content-end">' +--}}
                {{--            '<a href="{{ route('admin.om.show', "") }}/' + row["id"] + '" class="btn btn-link btn-sm btn-primary btn-just-icon view" data-original-title="" title="">'--}}
                {{--            + '<i class="material-icons">visibility</i>'--}}
                {{--            + '</a>'--}}
                {{--            + '<a href="./om/'+row["id"]+'/edit" class="btn btn-link btn-sm btn-primary btn-just-icon edit" data-original-title="" title="">'--}}
                {{--            + '<i class="material-icons">edit</i>'--}}
                {{--            + '</a>'--}}
                {{--            + '<button data-form-id="form-delete-'+row["id"]+'" class="btn btn-link btn-sm btn-danger btn-just-icon remove btn-delete">'--}}
                {{--            + '<i class="material-icons">delete_forever</i>'--}}
                {{--            + '</button>'--}}
                {{--            + '<form id="form-delete-'+row["id"]+'" action="{{ route('admin.om.destroy', "") }}/' + row["id"] + '" class="form-horizontal" method="POST">'--}}
                {{--            + '@csrf'--}}
                {{--            + '@method("DELETE")'--}}
                {{--            + '</form>'--}}
                {{--            + '</div>';--}}
                {{--        --}}{{--        <i class="material-icons">remove_red_eye</i>--}}
                {{--        --}}{{--    </a>--}}
                {{--        --}}{{--    <a href="{{ route('hangar.aeronaves.frota.edit',[$acft->id]) }}" class="btn btn-link btn-sm btn-info btn-just-icon edit" data-original-title="" title="">--}}
                {{--        --}}{{--        <i class="material-icons">edit</i>--}}
                {{--        --}}{{--    </a>--}}
                {{--        --}}{{--    <a href="javascript:();" data-form-id="form-delete-{{ $acft->id }}" class="btn btn-link btn-sm btn-danger btn-just-icon remove btn-delete">--}}
                {{--        --}}{{--        <i class="material-icons">delete_forever</i>--}}
                {{--        --}}{{--    </a>--}}
                {{--        --}}{{--    <form id="form-delete-{{ $acft->id }}" action="{{ route('hangar.aeronaves.frota.destroy',[$acft]) }}" class="form-horizontal" method="POST">--}}
                {{--        --}}{{--        @csrf--}}
                {{--        --}}{{--        @method('DELETE')--}}
                {{--        --}}{{--    </form>';--}}
                {{--        --}}{{--</td>--}}




                {{--        --}}{{--return '<div class="text-right"><a href="{{ route('admin.om.show', "") }}/' + row["id"] + '" class="btn btn-link btn-primary btn-just-icon like-av"><i class="material-icons">visibility</i></a></div>';--}}
                {{--        // return '<div class="text-right"><a href="#/' + row["id"] + '" class="btn btn-link btn-primary btn-just-icon like-av"><i class="material-icons">add_box</i></a></div>';--}}
                {{--    }--}}
                {{--}]--}}
            });

        });
    </script>

@endpush
