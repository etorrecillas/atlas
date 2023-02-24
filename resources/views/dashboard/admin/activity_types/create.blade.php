@extends('layout.dashboard.index')

@section('page_title', 'Administração | Tipos de Atividade | Cadastrar Novo Tipo de Atividade')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">add</i>
                    </div>
                    <h4 class="card-title">Cadastrar novo Tipo de Atividade</h4>
                </div>
                <div class="card-body ">

                    <div class="container">
                        <div class="tab-content tab-space">
                            <form id="typeCreate" action="{{ route('admin.tipos_atividade.store') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Sigla</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('short') is-focused @enderror">
                                            <input value="{{ old('short') }}" name="short" type="text" class="form-control @error('short') error @enderror">
                                            <span class="bmd-help">Ex.: RT</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Tipo*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('type') is-focused @enderror">
                                            <input value="{{ old('type') }}" name="type" type="text" class="form-control @error('type') error @enderror" required aria-required="true">
                                            <span class="bmd-help">Ex.: Relatório Técnico</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    &nbsp;
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
                                    <a href="{{ route('admin.tipos_atividade.index') }}" class="btn btn-primary pull-left">Voltar</a>
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
            $("#typeCreate").validate({
                messages: {
                    type: "Informe o tipo da atividade",
                }
            });
        });

    </script>

@endpush
