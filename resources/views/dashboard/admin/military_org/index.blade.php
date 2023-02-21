@extends('layout.dashboard.index')

@section('page_title', 'Administração | Organizações Militares')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">list</i>
                    </div>
                    <h4 class="card-title">Listar OM</h4>
                </div>
                <div class="card-body ">
                    <div class="container">
                        <div class="tab-content tab-space">
                            <div class="row">
                                <div class="table-responsive table-striped">
                                    <table id="datatable_om" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th data-priority="1">Sigla</th>
                                            <th data-priority="2">Nome</th>
                                            <th data-priority="3">Atividades</th>
                                            <th data-priority="4">Usuários</th>
                                            <th data-priority="5" data-orderable="false" class="disabled-sorting text-right">Ações</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Sigla</th>
                                            <th>Nome</th>
                                            <th>Atividades</th>
                                            <th>Usuários</th>
                                            <th data-orderable="false" class="disabled-sorting text-right">Ações</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($allOm as $om)
                                            <tr>
                                                <td>{{ $om->short }}</td>
                                                <td>{{ $om->title }}</td>
                                                <td>{{ $om->activities_count }}</td>
                                                <td>{{ $om->users_count }}</td>
                                                <td>
                                                    <div class="td-actions text-right justify-content-end">
                                                        <a href="{{ route('admin.om.show', $om) }}" class="btn btn-link btn-sm btn-primary btn-just-icon view" data-original-title="" title="">
                                                            <i class="material-icons">visibility</i>
                                                        </a>
                                                        <a href="#" class="btn btn-link btn-sm btn-primary btn-just-icon edit" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <button data-form-id="form-delete-{{ $om->id }}" class="btn btn-link btn-sm btn-danger btn-just-icon remove btn-delete">
                                                            <i class="material-icons">delete_forever</i>
                                                        </button>
                                                        <form id="form-delete-{{ $om->id }}" action="{{ route('admin.om.destroy', $om) }}" class="form-horizontal" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('admin.om.create') }}" class="btn btn-primary pull-left">+ Cadastrar nova OM</a>
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
        $(document).ready(function () {

            // $.fn.dataTable.moment('DD/MM/YYYY HH:mm');

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

            $(".btn-delete").click(function(){
                let formId = $(this).data('form-id');
                swal({
                    title: 'Você tem certeza?',
                    type: 'warning',
                    text: 'Militares e atividades desta OM ficarão sem OM atribuída',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function(confirm) {
                    if(confirm.value)
                    {
                        $('#'+formId).submit();
                    }
                });
            });

        });




        //
        //
        //
        //
        //     $("#table").DataTable({
        //         columnDefs: [
        //             { orderable: false, targets: [2,3] },
        //             { searchable: false, targets: 3}
        //         ],
        //         language: {
        //             url: "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
        //         }
        //     });
        // });

    </script>

@endpush
