


<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Contratos Por Categoria</h3>
                <h3 class="card-title">Total: {!! $total !!}</h3>
                <a href="/contrato">Mais detalhes</a>
            </div>
        </div>
        <div class="card-body">

            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="chartCategoria" height="200" style="display: block; width: 487px; height: 200px;" width="487" class="chartjs-render-monitor"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Categoria
                  </span>
            </div>
        </div>
    </div>


</div>

@push('js')
    <script>
        $(function () {

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $chartCategoria = $('#chartCategoria')
            var chartCategoria = new Chart($chartCategoria, {
                type: 'bar',
                data: {
                    labels: '{{$arrDesc}}'.split("|-|"),
                    datasets: [
                        {
                            backgroundColor: '#17a2b8',
                            borderColor: '#007bff',
                            data: '{{$arrValues}}'.split("|-|")
                        },
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }
                                    return '' + value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        });
    </script>
@endpush

