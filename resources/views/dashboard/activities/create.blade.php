@extends('layout.dashboard.index')

@section('page_title', 'Atividades | Cadastrar Nova Atividade')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">add</i>
                    </div>
                    <h4 class="card-title">Cadastrar nova Atividade</h4>
                </div>
                <div class="card-body ">

                    <div class="container">
                        <div class="tab-content tab-space">
                            <form id="atvCreate" action="{{ route('atividades.store') }}" method="post" novalidate="novalidate">
                                @csrf
                                @if(auth()->user()->isAdmin())
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">OM*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="dropdown bootstrap-select form-group" style="margin-top: 0px;">
                                            <select name="military_organization_id" class="selectpicker" data-style="select-with-transition" title="Selecionar" data-size="7" data-live-search="true" required aria-required="true">
                                                @foreach($militaryOrg as $om)
                                                    <option value="{{ $om->id }}" {{ old('military_organization_id') == $om->id ? "selected" : ""}}>{{ $om->short }} ({{ $om->title }}) </option>
                                                @endforeach
                                            </select>
                                            @error('military_organization_id')<label style="margin-top: 50px; width: 300px;" id="email-error" class="error" for="code">{{ $message }}</label>@enderror
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">OM*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="col-md-9 col-form-label text-left">
                                            @if(isset(auth()->user()->militaryOrg->short))
                                                <p>{{ auth()->user()->militaryOrg->short }} ({{ auth()->user()->militaryOrg->title }})</p>
                                            @else
                                                <p>Usuário não vinculado a uma OM</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Data de Conclusão*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('finished_date') is-focused @enderror">
                                            <input value="{{ old('finished_date') ? \Carbon\Carbon::createFromFormat('Y-m-d', old('finished_date'))->format('d/m/Y') : '' }}" type="text" name="finished_date" class="form-control datepicker @error('finished_date') error @enderror " required aria-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Subdiretoria*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="dropdown bootstrap-select form-group" style="margin-top: 0px;">
                                            <select name="sector" class="selectpicker" data-style="select-with-transition" title="Selecionar" data-size="3" data-live-search="true" required aria-required="true">
                                                <option value="SDA" {{ old('sector') == "SDA" ? "selected" : ""}}>SDA (Administração)</option>
                                                <option value="SDE" {{ old('sector') == "SDE" ? "selected" : ""}}>SDE (Engenharia)</option>
                                                <option value="SDP" {{ old('sector') == "SDP" ? "selected" : ""}}>SDP (Patrimônio)</option>
                                            </select>
                                            @error('sector')<label style="margin-top: 50px; width: 300px;" id="sector-error" class="error" for="code">{{ $message }}</label>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Tipo*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="dropdown bootstrap-select form-group" style="margin-top: 0px;">
                                            <select name="activity_type_id" class="selectpicker" data-style="select-with-transition" title="Selecionar" data-size="7" data-live-search="true" required aria-required="true">
                                                @foreach($activityTypes as $type)
                                                    <option value="{{ $type->id }}" {{ old('activity_type_id') == $type->id ? "selected" : ""}}>{{ isset($type->short) ? $type->title." (".$type->short.")" : $type->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('military_organization_id')<label style="margin-top: 50px; width: 300px;" id="email-error" class="error" for="code">{{ $message }}</label>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Número</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('reference_number') is-focused @enderror">
                                            <input value="{{ old('reference_number') }}" name="reference_number" type="text" class="form-control @error('reference_number') error @enderror">
                                            <span class="bmd-help">Ex.: 01/RT/DTINFRA-SP/21022023</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Título*</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('title') is-focused @enderror">
                                            <input value="{{ old('title') }}" name="title" type="text" class="form-control @error('title') error @enderror" required aria-required="true">
                                            <span class="bmd-help">Ex.: Relatório de Desenvolvimento do Sistema ATLAS</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Valor*</label>
                                    <div class="col-sm-3 col-md-2" id="value_div">
                                        <div class="form-group bmd-form-group @error('value') is-focused @enderror">
                                            <input name="value" value="{{ old('front_value') }}" id="value" type="text" class="form-control @error('value') error @enderror">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-2">
                                        <div class="form-group bmd-form-group @error('value') is-focused @enderror">
                                            <div style="padding-top: 10px;" class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" id="checkbox_na" type="checkbox" name="not_applicable_value" value="1" {{ old('not_applicable_value') == 1 ? 'checked' : '' }}> N/A
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-md-2 col-form-label">Observações</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="form-group bmd-form-group @error('comments') is-focused @enderror">
                                            <textarea rows="6" class="form-control @error('comments') error @enderror" name="comments">{!! old('comments') !!}</textarea>
                                            <span class="bmd-help">Ex.: Digite observações que julgar relevante (máx. 250 caracteres)</span>
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
                                    <a href="{{ route('atividades.index') }}" class="btn btn-primary pull-left">Voltar</a>
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
    <script src="{{ asset('assets/js/plugins/jquery.mask-money.js') }}"></script>
@endpush

@push('extra_script')
    <script>
        $(document).ready(function() {

            $('#value').maskMoney({
                prefix:'R$ ',
                allowNegative: false,
                thousands:'.',
                decimal:',',
                allowEmpty: true,
                affixesStay: true,
                allowZero: true
            });

            if($('#checkbox_na').is(":checked")) {
                $('#value').val('');
                $('#value').attr('disabled', true);
                $('#value_div').hide();
            }

            $('#checkbox_na').change(function() {
                if($(this).is(":checked")) {
                    $('#value').val('');
                    $('#value').attr('disabled', true);
                    $('#value_div').hide();
                } else {
                    $('#value').val('');
                    $('#value').attr('disabled', false);
                    $('#value_div').show();
                }
            });

            $('.datepicker').datetimepicker({
                locale: 'pt-br',
                format: 'L',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });



            $("#atvCreate").validate({
                rules: {
                    comments: {
                        maxlength: 250
                    }
                },
                messages: {
                    comments: {
                        maxlength: "Máximo de 250 caracteres"
                    },
                    military_organization_id: "Selecione a OM",
                    finished_date: "Informe a data de conclusão",
                    activity_type_id: "Selecione o tipo de atividade",
                    title: "Informe o título da atividade",
                    sector: "Selecione a subdiretoria",
                }
            });
        });

    </script>

@endpush
