@extends('layout.dashboard.index')

@section('page_title', 'Atividades | '. $activity->type_name . ': '.$activity->title . ' (' . $activity->om_name .')')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">visibility</i>
                    </div>
                    <h4 class="card-title">{{ $activity->type_name . ': '.$activity->title . ' (' . $activity->om_name .')' }}</h4>
                </div>
                <div class="card-body ">

                    <div class="container">
                        <div class="tab-content tab-space">
                            <div class="row">
                                <label class="col-md-3 col-form-label">OM</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $activity->om_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Data de Conclusão</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $activity->finished_date->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Subdiretoria</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ isset($activity->sector) ? $activity->sector : "Sem Subdiretoria" }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Tipo</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $activity->type_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Número</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{!! isset($activity->reference_number) ? $activity->reference_number : '&nbsp;' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Título</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $activity->title }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Valor</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{{ $activity->value_show }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Observações</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{!! isset($activity->comments) ? $activity->comments : '&nbsp;' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Cadastrado por</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{!! isset($activity->user_name) ? $activity->user_name : '&nbsp;' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Data cadastro</label>
                                <div class="col-md-9">
                                    <div class="col-md-9 col-form-label text-left">
                                        <p>{!! isset($activity->created_at) ? $activity->created_at->format('d/m/Y H:i') : '&nbsp;' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                        </div>
                        @if(auth()->user()->isAdmin() || auth()->user()->militaryOrg->id == $activity->military_organization_id)
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form id="atvDelete" action="{{ route('atividades.destroy', $activity) }}" method="post">
                                    <a href="{{ route('atividades.edit', $activity) }}" class="btn btn-sm btn-primary">Editar Atividade</a>&nbsp;
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger btn-delete" type="submit">Excluir Atividade</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('atividades.index') }}" class="btn btn-primary pull-left">Voltar</a>
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
            $(".btn-delete").click(function (e) {
                e.preventDefault();
                swal({
                    title: 'Você tem certeza?',
                    type: 'warning',
                    text: 'A atividade será excluída',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function(confirm) {
                    if(confirm.value)
                    {
                        $('#atvDelete').submit();
                    }
                });

            });
        });
    </script>
@endpush
