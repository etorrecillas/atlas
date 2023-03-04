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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="grafico1">
                                <p id="chartText1"></p>
                                <canvas id="myChart1"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="grafico2">
                                <p id="chartText2"></p>
                                <canvas id="myChart2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="grafico3">
                                <p id="chartText3"></p>
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="grafico4">
                                <p id="chartText4"></p>
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="grafico5">
                                <p id="chartText5"></p>
                                <canvas id="myChart5"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="grafico6">
                                <p id="chartText6"></p>
                                <canvas id="myChart6"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="grafico7">
                                <p id="chartText7"></p>
                                <canvas id="myChart7"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="grafico8">
                                <p id="chartText8"></p>
                                <canvas id="myChart8"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">&nbsp;</div>
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

            $('#myChart1').replaceWith('<canvas id="myChart1"></canvas>');
            $('#myChart2').replaceWith('<canvas id="myChart2"></canvas>');
            $('#myChart3').replaceWith('<canvas id="myChart3"></canvas>');
            $('#myChart4').replaceWith('<canvas id="myChart4"></canvas>');
            $('#myChart5').replaceWith('<canvas id="myChart5"></canvas>');
            $('#myChart6').replaceWith('<canvas id="myChart6"></canvas>');
            $('#myChart7').replaceWith('<canvas id="myChart7"></canvas>');
            $('#myChart8').replaceWith('<canvas id="myChart8"></canvas>');

            const ctx1 = document.getElementById('myChart1');
            const ctx2 = document.getElementById('myChart2');
            const ctx3 = document.getElementById('myChart3');
            const ctx4 = document.getElementById('myChart4');
            const ctx5 = document.getElementById('myChart5');
            const ctx6 = document.getElementById('myChart6');
            const ctx7 = document.getElementById('myChart7');
            const ctx8 = document.getElementById('myChart8');

            new Chart(ctx1, {
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
                            text: 'Total de atividades x OM/Divisão'
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
                            text: 'Atividades por Subdiretoria x OM/Divisão'
                        },
                        legend: {
                            position: 'bottom',
                            display: false
                        }
                    }
                }
            });

            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: data.chart3.labels,
                    datasets: [{
                        label: 'Total de atividades (SDA)',
                        data: data.chart3.totals,
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
                            text: 'Total de atividades (SDA) x OM/Divisão'
                        },
                        legend: {
                            display: false,
                            position: 'bottom',
                        }
                    }
                },
                responsive: true,
            });

            new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: data.chart4.labels,
                    datasets: data.chart4.datasets
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
                            text: 'Tipos de atividade (SDA) x OM/Divisão'
                        },
                        legend: {
                            position: 'bottom',
                            display: false
                        }
                    }
                }
            });

            new Chart(ctx5, {
                type: 'bar',
                data: {
                    labels: data.chart5.labels,
                    datasets: [{
                        label: 'Total de atividades (SDE)',
                        data: data.chart5.totals,
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
                            text: 'Total de atividades (SDE) x OM/Divisão'
                        },
                        legend: {
                            display: false,
                            position: 'bottom',
                        }
                    }
                },
                responsive: true,
            });

            new Chart(ctx6, {
                type: 'bar',
                data: {
                    labels: data.chart6.labels,
                    datasets: data.chart6.datasets
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
                            text: 'Tipos de atividade (SDE) x OM/Divisão'
                        },
                        legend: {
                            position: 'bottom',
                            display: false
                        }
                    }
                }
            });

            new Chart(ctx7, {
                type: 'bar',
                data: {
                    labels: data.chart7.labels,
                    datasets: [{
                        label: 'Total de atividades (SDP)',
                        data: data.chart7.totals,
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
                            text: 'Total de atividades (SDP) x OM/Divisão'
                        },
                        legend: {
                            display: false,
                            position: 'bottom',
                        }
                    }
                },
                responsive: true,
            });

            new Chart(ctx8, {
                type: 'bar',
                data: {
                    labels: data.chart8.labels,
                    datasets: data.chart8.datasets
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
                            text: 'Tipos de atividade (SDP) x OM/Divisão'
                        },
                        legend: {
                            position: 'bottom',
                            display: false
                        }
                    }
                }
            });





        }


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


