@extends('layouts.template')
@section('title')
    {{ __('messages.cashflow_report') }}
@endsection

@section('style')
    <style>
        .doughnut-chart {
            height: 160px!important;
            width: 160px!important;
            margin: auto!important;
        }

        table.table-responsive th:first-child,
        table.table-responsive td:first-child {
            width: 30%;
        }

        table.table-responsive th:nth-child(2),
        table.table-responsive td:nth-child(2) {
            width: 50%;
        }

        table.table-responsive th:nth-child(3),
        table.table-responsive td:nth-child(3) {
            width: 20%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="card my-4 mr-1 pb-2">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h6 class="text-white text-capitalize ps-3">
                                {{ __('messages.cashflow_report') }}
                            </h6>
                        </div>
                        <div class="col-3 text-end pr-2 pb-h">
                            <span class="text-sm font-weight-md text-white">
                                {{ __('messages.dated_at') }} : {{ date('Y-m-d') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body px-0 pb-2 table-padding">
                <div id="dt-table"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            reloadCashflowReportTable(getQueryParams());
        });

        // filter
        $("#submit-filter-button").on('click', function() {
            reloadCashflowReportTable(getQueryParams());
        });

        // reload table
        function reloadCashflowReportTable(queryParams = null) {
            $.ajax({
                url: '{{ route("cashflow_reports.index") }}?' + queryParams,
                type: 'GET',
                data: { },
                success: function(data) {
                    $('#dt-table').html(data.table);
                    generateCashflowChart(data.data, data.totals);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // doughnut chart
        function createDoughnutChart(canvasId, labels, data, backgroundColors, borderColors) {
            const config = {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            };
            
            return new Chart(document.getElementById(canvasId), config);
        }

        // generate chart
        function generateCashflowChart(data, totals) 
        {
            const backgroundColors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)'];
            const borderColors = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'];
            
            const chart1Labels = ['Net Cash Flow'];
            const chart1Data = [totals['total_operation_net_cashflow']];
            data.filter(row => row.activity_type === 1 && row.action_type === 2).forEach(row => {
                chart1Labels.push(row['name']);
                chart1Data.push(row['total_amount']);
            });

            const chart2Labels = ['Net Cash Flow'];
            const chart2Data = [totals['total_investing_net_cashflow']];
            data.filter(row => row.activity_type === 2 && row.action_type === 2).forEach(row => {
                chart2Labels.push(row['name']);
                chart2Data.push(row['total_amount']);
            });

            const chart3Labels = ['Net Cash Flow'];
            const chart3Data = [totals['total_financing_net_cashflow']];
            data.filter(row => row.activity_type === 3 && row.action_type === 2).forEach(row => {
                chart3Labels.push(row['name']);
                chart3Data.push(row['total_amount']);
            });

            const chart1 = createDoughnutChart('chart1',chart1Labels,chart1Data,backgroundColors,borderColors);
            const chart2 = createDoughnutChart('chart2',chart2Labels,chart2Data,backgroundColors,borderColors);
            const chart3 = createDoughnutChart('chart3',chart3Labels,chart3Data,backgroundColors,borderColors);
        }
    </script>
@endsection
