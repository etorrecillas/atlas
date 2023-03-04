@extends('layout.dashboard.index')

@section('page_title', 'Atividades')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">list</i>
                    </div>
                    <h4 class="card-title">Listar Atividades</h4>
                </div>
                <div class="card-body ">
                    <div class="container">
                        <div class="tab-content tab-space">
                            <div class="row">
                                <div class="table-responsive table-striped">
                                    <table id="datatable_atv" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th data-priority="1">Data de Conclusão</th>
                                            <th data-priority="2">OM</th>
                                            <th data-priority="3">Tipo</th>
                                            <th data-priority="4">Número</th>
                                            <th data-priority="5">Título</th>
                                            <th data-priority="6">Valor</th>
                                            <th data-priority="7" data-orderable="false" class="disabled-sorting text-right">Detalhes</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Data de Conclusão</th>
                                            <th>OM</th>
                                            <th>Tipo</th>
                                            <th>Número</th>
                                            <th>Título</th>
                                            <th>Valor</th>
                                            <th data-orderable="false" class="disabled-sorting text-right">Detalhes</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
{{--                                        @foreach($allUsers as $user)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{ $user->ranking->short }}</td>--}}
{{--                                                <td>{{ $user->name }}</td>--}}
{{--                                                <td>{{ isset($user->militaryOrg->short) ? $user->militaryOrg->short : "Sem OM" }}</td>--}}
{{--                                                <td>{{ $user->email }}</td>--}}
{{--                                                <td>{{ isset($user->roles->first()->title) ? $user->roles->first()->title : "Sem Perfil" }}</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="td-actions text-right justify-content-end">--}}
{{--                                                        <a href="{{ route('admin.usuarios.show', $user) }}" class="btn btn-link btn-sm btn-primary btn-just-icon view" data-original-title="" title="">--}}
{{--                                                            <i class="material-icons">visibility</i>--}}
{{--                                                        </a>--}}
{{--                                                        <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn btn-link btn-sm btn-primary btn-just-icon edit" data-original-title="" title="">--}}
{{--                                                            <i class="material-icons">edit</i>--}}
{{--                                                        </a>--}}
{{--                                                        @if($user->id != auth()->user()->id)--}}
{{--                                                            <button data-form-id="form-delete-{{ $user->id }}" class="btn btn-link btn-sm btn-danger btn-just-icon remove btn-delete">--}}
{{--                                                                <i class="material-icons">delete_forever</i>--}}
{{--                                                            </button>--}}

{{--                                                            <form id="form-delete-{{ $user->id }}" action="{{ route('admin.usuarios.destroy', $user) }}" class="form-horizontal" method="POST">--}}
{{--                                                                @csrf--}}
{{--                                                                @method("DELETE")--}}
{{--                                                            </form>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('atividades.create') }}" class="btn btn-primary pull-left">+ Cadastrar nova atividade</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('extra_js')
    <script src="https://cdn.datatables.net/plug-ins/1.11.4/sorting/datetime-moment.js"></script>
@endpush

@push('extra_script')

    <script>
        $(document).ready(function () {

            $.fn.dataTable.moment('DD/MM/YYYY');
            $('#datatable_atv thead tr').clone(true).appendTo('#datatable_atv thead');
            $('#datatable_atv thead tr:eq(0) th').each(function(i) {
                var searchable = [0, 1, 2, 3, 4];
                if (searchable.includes(i)) {
                    var title = $(this).text();
                    $(this).html('<input class="form-control form-control-sm" type="text" placeholder="Pesquisar ' + title + '" />');

                    $('input', this).on('keyup change', function() {
                        if (table.column(i).search() !== this.value) {
                            table
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });

                } else {
                    $(this).html('');
                }
            });


            var table = $('#datatable_atv').DataTable({
                dom: 'lfrtipB',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },
                order: [[0, 'desc']],
                pagingType: "full_numbers",
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                processing: true,
                ajax: "{{ route('atividades.index.ajax') }}",
                columns: [
                    {"data": "finish_date"},
                    {"data": "om_name"},
                    {"data": "type_act_index"},
                    {"data": "reference_number"},
                    {"data": "title"},
                    {
                        "data": "value",
                        "render": $(this).DataTable.render.number('.', ',', 2, 'R$ ')
                    },
                    {"data": ""}
                ],
                responsive: true,
                buttons: {
                    buttons:
                        [
                            {
                                extend: "excelHtml5",
                                className: "btn-sm btn-success",
                                title: "atlas_lista_atividades",
                                exportOptions: {
                                    columns: ':not(:last-child)',
                                }
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm btn-danger",
                                title: "atlas_lista_atividades",
                                exportOptions: {
                                    columns: ':not(:last-child)',
                                }
                            },
                            {
                                extend: "copyHtml5",
                                className: "btn-sm btn-info",
                                title: "atlas_lista_atividades",
                                text: "Copiar",
                                exportOptions: {
                                    columns: ':not(:last-child)',
                                }
                            },
                            {
                                extend: "print",
                                className: "btn-sm btn-info",
                                title: "atlas_lista_atividades",
                                text: "Imprimir",
                                exportOptions: {
                                    columns: ':not(:last-child)',
                                }
                            }
                        ],
                },
                columnDefs: [
                    { orderable: false, targets: [5, 6] },
                    { searchable: false, targets: 6},
                    {
                        targets: -1,
                        render: function (data, type, row) {
                            return '<div class="text-right"><a href="{{ route('atividades.show', "") }}/' + row["id"] + '" class="btn btn-link btn-primary btn-just-icon like-av"><i class="material-icons">add_box</i></a></div>';
                        }
                    }
                ],


            });

            $(".btn-delete").click(function(){
                let formId = $(this).data('form-id');
                swal({
                    title: 'Você tem certeza?',
                    type: 'warning',
                    text: 'O usuário será excluído permanentemente!',
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

    </script>

@endpush
