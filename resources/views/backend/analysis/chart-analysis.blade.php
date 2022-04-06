@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Bar Chart</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('js')
<script>
    $(function() {

        var cei_url = "{{url('/cei/barchart')}}";
        var cei_count = new Array();
        var cei_month = new Array();
        var kobo_count = new Array();
        var kobo_month = new Array();

        $.get(cei_url, function(response) {
            response.forEach(function(data) {
                cei_count.push(data.count);
                cei_month.push(data.month);
            });

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d');

            var barChartData = {
                labels: cei_month,
                datasets: [{
                        label: 'Client Exit',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: cei_count
                    },
                    // {
                    //     label: 'Client Exit (Kobo Collect)',
                    //     backgroundColor: 'rgba(210, 214, 222, 1)',
                    //     borderColor: 'rgba(210, 214, 222, 1)',
                    //     pointRadius: false,
                    //     pointColor: 'rgba(210, 214, 222, 1)',
                    //     pointStrokeColor: '#c1c7d1',
                    //     pointHighlightFill: '#fff',
                    //     pointHighlightStroke: 'rgba(220,220,220,1)',
                    //     data: [65, 59, 80, 81]
                    // },
                ]
            }

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

        });
    });
</script>
@endsection