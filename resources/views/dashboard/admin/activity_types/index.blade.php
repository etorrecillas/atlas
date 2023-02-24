@extends('layout.dashboard.index')

@section('page_title', 'Administração | Tipos de Atividade')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">list</i>
                    </div>
                    <h4 class="card-title">Listar Tipos de Atividade</h4>
                </div>
                <div class="card-body ">
                    <div class="container">
                        <div class="tab-content tab-space">
                            <div class="row">
                                <div class="table-responsive table-striped">
                                    <table id="datatable_type" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th data-priority="1">Tipo</th>
                                            <th data-priority="3">Sigla</th>
                                            <th data-priority="2">Atividades</th>
                                            <th data-priority="4" data-orderable="false" class="disabled-sorting text-right">Ações</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Sigla</th>
                                            <th>Atividades</th>
                                            <th data-orderable="false" class="disabled-sorting text-right">Ações</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($allTypes as $type)
                                            <tr>
                                                <td>{{ $type->title }}</td>
                                                <td>{{ isset($type->short) ? $type->short : "" }}</td>
                                                <td>{{ $type->activities()->count() }}</td>
                                                <td>
                                                    <div class="td-actions text-right justify-content-end">
                                                        <a href="{{ route('admin.tipos_atividade.show', $type) }}" class="btn btn-link btn-sm btn-primary btn-just-icon view" data-original-title="" title="">
                                                            <i class="material-icons">visibility</i>
                                                        </a>
                                                        <a href="{{ route('admin.tipos_atividade.edit', $type) }}" class="btn btn-link btn-sm btn-primary btn-just-icon edit" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <button data-form-id="form-delete-{{ $type->id }}" class="btn btn-link btn-sm btn-danger btn-just-icon remove btn-delete">
                                                            <i class="material-icons">delete_forever</i>
                                                        </button>
                                                        <form id="form-delete-{{ $type->id }}" action="{{ route('admin.tipos_atividade.destroy', $type) }}" class="form-horizontal" method="POST">
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
                                    <a href="{{ route('admin.tipos_atividade.create') }}" class="btn btn-primary pull-left">+ Cadastrar novo tipo de atividade</a>
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
            $('#datatable_type thead tr').clone(true).appendTo('#datatable_type thead');
            $('#datatable_type thead tr:eq(0) th').each(function(i) {
                var searchable = [0, 1];
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

            var table = $('#datatable_type').DataTable({
                dom: 'lfrtipB',
                language: {
                    "url": 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },
                order: [[0, 'asc']],
                pagingType: "full_numbers",
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                responsive: true,
                buttons: {
                    buttons:
                        [
                            {
                                extend: "excelHtml5",
                                className: "btn-sm btn-success",
                                title: "atlas_lista_om",
                                exportOptions: {
                                    columns: ':not(:last-child)',
                                }
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm btn-danger",
                                title: "atlas_lista_om",
                                exportOptions: {
                                    columns: ':not(:last-child)',
                                }
                            },
                            {
                                extend: "copyHtml5",
                                className: "btn-sm btn-info",
                                title: "atlas_lista_om",
                                text: "Copiar",
                                exportOptions: {
                                    columns: ':not(:last-child)',
                                }
                            },
                            {
                                extend: "print",
                                className: "btn-sm btn-info",
                                title: "atlas_lista_om",
                                text: "Imprimir",
                                exportOptions: {
                                    columns: ':not(:last-child)',
                                }
                            }
                        ],
                },
                columnDefs: [
                    { orderable: false, targets: [3] },
                    { searchable: false, targets: [2,3]}
                ],


            });

            $(".btn-delete").click(function(){
                let formId = $(this).data('form-id');
                swal({
                    title: 'Você tem certeza?',
                    type: 'warning',
                    text: 'Atividades deste tipo ficarão sem tipo atribuído',
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
