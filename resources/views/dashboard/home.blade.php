@extends('layout.dashboard.index')

@section('page_title')
    Início
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-3">
            <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">checklist</i>
                    </div>
                    <h3 class="card-title">{{ $cards['atv'] }}</h3>
                    <p class="card-category">atividades concluídas</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3">
            <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">event</i>
                    </div>
                    <h3 class="card-title">{{ $cards['yearAtv'] }}</h3>
                    <p class="card-category">atividades concluídas em {{ \Carbon\Carbon::now()->format('Y') }}</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3">
            <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">local_police</i>
                    </div>
                    <h3 class="card-title">{{ $cards['om'] }}</h3>
                    <p class="card-category">OM/divisões cadastradas</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3">
            <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">groups</i>
                    </div>
                    <h3 class="card-title">{{ $cards['users'] }}</h3>
                    <p class="card-category">usuários cadastrados</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">insert_chart</i>
                    </div>
                    <h4 class="card-title">Comparativo entre OM/divisões</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="grafico">
                                <p id="chartText"></p>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="grafico2">
                                <p id="chartText2"></p>
                                <canvas id="myChart2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">&nbsp;</div>
                    <div class="row" id="filter">
                        <div class="container">
                            <div class="col-lg-12 text-center">
                                Filtrar período:
                                <input type="text" value="{{ \Carbon\Carbon::now('America/Sao_Paulo')->firstOfYear()->format('d/m/Y') }}" name="started_date" class="datepicker ">
                                a
                                <input type="text" value="{{ \Carbon\Carbon::now('America/Sao_Paulo')->lastOfYear()->format('d/m/Y') }}" name="ended_date" class="datepicker ">
                                <button class="btn btn-primary btn-sm" id="btnFilter">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('extra_js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush


@push('extra_script')
    <script>

        function ajaxData(from, to) {

            $.ajax({
                url: "{{ route('ajaxChart') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    dateStart: from,
                    dateEnd: to
                },
                beforeSend: function () {
                    $("#filter").hide();
                    $("#chartText").html("Preparando plotagem...");
                },
                success: function (data) {
                    $("#chartText").html("");
                    makeChart(data);
                    $("#filter").show();
                },
                error: function (data) {
                    swal("Erro!", "Erro ao carregar dados para a plotagem!", "error");
                    $("#chartText").html("Plotagem indisponível");

                }
            });

        }

        function makeChart(data) {

            $('#myChart').replaceWith('<canvas id="myChart"></canvas>');
            $('#myChart2').replaceWith('<canvas id="myChart2"></canvas>');

            const ctx = document.getElementById('myChart');
            const ctx2 = document.getElementById('myChart2');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.chart1.labels,
                    datasets: [{
                        label: 'Total de atividades',
                        data: data.chart1.totals,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total de atividades por OM/divisão'
                        },
                        legend: {
                            display: false,
                            position: 'bottom',
                        }
                    }
                },
                responsive: true,
            });


            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: data.chart2.labels,
                    datasets: data.chart2.datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            },
                            max: 100,
                            title: {
                                display: true,
                                text: 'Percentual',
                                font: {
                                    weight: 'bold',
                                }
                            }

                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Tipos de atividade por OM/divisão'
                        },
                        legend: {
                            position: 'bottom',
                            display: false
                        }
                    }
                }
            });

        }


        // function updateChart(data) {
        //
        //     const ctx = document.getElementById('myChart');
        //     const ctx2 = document.getElementById('myChart2');
        //
        //     new Chart(ctx, {
        //         type: 'bar',
        //         data: {
        //             labels: data.chart1.labels,
        //             datasets: [{
        //                 label: 'Total de atividades',
        //                 data: data.chart1.totals,
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             scales: {
        //                 y: {
        //                     beginAtZero: true,
        //                     ticks: {
        //                         stepSize: 1
        //                     }
        //                 }
        //             },
        //             plugins: {
        //                 title: {
        //                     display: true,
        //                     text: 'Total de atividades por OM/divisão'
        //                 },
        //                 legend: {
        //                     display: false,
        //                     position: 'bottom',
        //                 }
        //             }
        //         },
        //         responsive: true,
        //     });
        //
        //
        //     new Chart(ctx2, {
        //         type: 'bar',
        //         data: {
        //             labels: data.chart2.labels,
        //             datasets: data.chart2.datasets
        //         },
        //         options: {
        //             responsive: true,
        //             scales: {
        //                 x: {
        //                     stacked: true,
        //                 },
        //                 y: {
        //                     stacked: true,
        //                     beginAtZero: true,
        //                     ticks: {
        //                         stepSize: 5
        //                     },
        //                     max: 100,
        //                     title: {
        //                         display: true,
        //                         text: 'Percentual',
        //                         font: {
        //                             weight: 'bold',
        //                         }
        //                     }
        //
        //                 }
        //             },
        //             plugins: {
        //                 title: {
        //                     display: true,
        //                     text: 'Tipos de atividade por OM/divisão'
        //                 },
        //                 legend: {
        //                     position: 'bottom',
        //                     display: false
        //                 }
        //             }
        //         }
        //     });
        //
        // }

        $(document).ready(function() {

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

            ajaxData('{{ Carbon\Carbon::now('America/Sao_Paulo')->firstOfYear()->format('d/m/Y') }}', '{{ Carbon\Carbon::now('America/Sao_Paulo')->lastOfYear()->format('d/m/Y') }}');

            $("#btnFilter").click(function () {
                let from = $("input[name='started_date']").val();
                let to = $("input[name='ended_date']").val();

                // alert(from + " - " + to);

                ajaxData(from, to);
            });
        });
    </script>
@endpush


