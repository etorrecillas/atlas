@extends('layout.dashboard.index')

@section('page_title', 'Administração | Organizações Militares | Editar OM')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">edit_note</i>
                    </div>
                    <h4 class="card-title">Editar OM {{ $militaryOrganization->short }}</h4>
                </div>
                <div class="card-body ">

                    <div class="container">
                        <div class="tab-content tab-space">
                            <form id="omUpdate" action="{{ route('admin.om.update', $militaryOrganization) }}" method="post" novalidate="novalidate">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Sigla*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('short') is-focused @enderror">
                                            <input value="{{ old('short', $militaryOrganization->short) }}" name="short" type="text" class="form-control @error('short') error @enderror" required aria-required="true">
                                            <span class="bmd-help">Ex.: DTINFRA-BR</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Nome*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('name') is-focused @enderror">
                                            <input value="{{ old('name', $militaryOrganization->title) }}" name="name" type="text" class="form-control @error('name') error @enderror" required aria-required="true">
                                            <span class="bmd-help">Ex.: Destacamento de Infraestrutura de Brasília</span>
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
                                                <button class="btn btn-primary pull-left" type="submit">Salvar Alterações</button>
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
                                    <a href="{{ route('admin.om.index') }}" class="btn btn-primary pull-left">Voltar</a>
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
            $("#omUpdate").validate({
                messages: {
                    short: "Informe a sigla da OM",
                    name: "Informe o nome da OM",
                }
            });
        });

    </script>

@endpush
