@push('js')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chart.js/chart.umd.js') }}"></script>

    <script>
        // Set Global Chart.js configuration
        Chart.defaults.color = '#818d96';
        Chart.defaults.scale.grid.color = "transparent";
        Chart.defaults.scale.grid.zeroLineColor = "transparent";
        Chart.defaults.scale.display = false;
        Chart.defaults.scale.beginAtZero = true;
        Chart.defaults.elements.line.borderWidth = 2;
        Chart.defaults.elements.point.radius = 5;
        Chart.defaults.elements.point.hoverRadius = 7;
        Chart.defaults.plugins.tooltip.radius = 3;
        Chart.defaults.plugins.legend.display = false;

        // Chart Containers
        let chartEcomEarningsCon = document.getElementById('chart-earnings');

        // Charts Variables
        let chartEcomOrders, chartEcomEarnings;
        window.addEventListener('renderChart', event => {
            console.log(event);
            
            let chartEcomEarningsData = {
                labels: event.detail.title,
                datasets: [{
                    label: 'Earnings',
                    fill: true,
                    backgroundColor: 'rgba(188,38,211,.25)',
                    borderColor: 'rgba(188,38,211,1)',
                    pointBackgroundColor: 'rgba(188,38,211,1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(188,38,211,1)',
                    data: event.detail.value
                }]
            };
            // Init Charts
            if (chartEcomEarningsCon !== null) {
                if (chartEcomEarnings) {
                    chartEcomEarnings.destroy();
                }
                chartEcomEarnings = new Chart(chartEcomEarningsCon, {
                    type: 'line',
                    data: chartEcomEarningsData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        tension: .4,
                        scales: {
                            y: {
                                suggestedMin: 0,
                                suggestedMax: 4300
                            }
                        },
                        interaction: {
                            intersect: false,
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ':' + new Intl.NumberFormat(
                                            "id-ID", {
                                                style: "currency",
                                                currency: "IDR",
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0,
                                            }).format(context.parsed.y)
                                    }
                                }
                            }
                        }
                    }
                });
            }
        })
    </script>
    @livewireScripts
@endpush
<div>

    <!-- Orders Overview -->
    <div class="content-heading d-flex justify-content-between align-items-center">
        <span>
            Orders <small class="d-none d-sm-inline">Overview</small>
        </span>
        <div class="dropdown">
            <button type="button" class="btn btn-sm btn-alt-secondary" id="ecom-orders-overview-drop"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span>{{$chart}}</span>
                <i class="fa fa-angle-down ms-1 opacity-50"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="ecom-orders-overview-drop">
                <a class="dropdown-item @if ($chart == 'This Week') active @endif" href="javascript:void(0)"
                    wire:click='week'>
                    <i class="fa fa-fw fa-calendar-alt opacity-50 me-1"></i> This Week
                </a>
                <a class="dropdown-item @if ($chart == 'This Month') active @endif" href="javascript:void(0)"
                    wire:click='month'>
                    <i class="fa fa-fw fa-calendar-alt opacity-50 me-1"></i> This Month
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Orders Earnings Chart -->
        <div class="col-md-12">
            <div class="block block-rounded block-mode-loading-refresh">
                <div class="block-header">
                    <h3 class="block-title">
                        Earnings
                    </h3>
                </div>
                <div class="block-content block-content-full bg-body-light text-center">
                    <div class="row g-sm">
                        <div class="col-6">
                            <div class="fs-sm fw-semibold text-uppercase text-muted">All</div>
                            <div class="fs-3 fw-semibold">@rupiah($earningTotal)</div>
                        </div>
                        <div class="col-6">
                            <div class="fs-sm fw-semibold text-uppercase text-muted">Count</div>
                            <div class="fs-3 fw-semibold text-success">{{ $earningCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="pull">
                        <!-- Earnings Chart Container -->
                        <canvas id="chart-earnings" style="height: 290px" data-chartTitle='{!! json_encode($earningChart['title']) !!}'
                            data-chartValue='{!! json_encode($earningChart['value']) !!}'></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Orders Earnings Chart -->
    </div>
    <!-- END Orders Overview -->
</div>
