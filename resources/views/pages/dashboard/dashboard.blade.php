@extends('template.main')
@section('css')

@endsection
@section('content-body')
    <div ng-controller="dashboardCtrl">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Alternatif</span>
                                <span class="info-box-number">
                                    {!! $data['c_alternatif'] !!}
                                    {{-- <small>%</small> --}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Nilai Crips</span>
                                <span class="info-box-number">{!! $data['c_nilaicrips'] !!}</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Kriteria</span>
                                <span class="info-box-number">{!! $data['c_kriteria'] !!}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Nilai Alternatif</span>
                                <span class="info-box-number">{!! $data['c_nilaialter'] !!}</span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{!! $data['c_alternatif'] !!}</h3>

                                <p>Alternatif</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{!! route('show_page', ['role' => $_SESSION['role'], 'pages' => 'alternatif']) !!}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{!! $data['c_nilaicrips'] !!}<sup style="font-size: 20px"></sup></h3>

                                <p>Nilai Crips</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{!! route('show_page', ['role' => $_SESSION['role'], 'pages' => 'nilai-crips']) !!}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{!! $data['c_kriteria'] !!}</h3>

                                <p>Kriteria</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{!! route('show_page', ['role' => $_SESSION['role'], 'pages' => 'kriteria']) !!}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{!! $data['c_nilaialter'] !!}</h3>

                                <p>Nilai Alternatif</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{!! route('show_page', ['role' => $_SESSION['role'], 'pages' => 'nilai-alternatif']) !!}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Ranking
                                </h3>
                                <div class="card-tools">
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <div class="chart tab-pane active" id="revenue-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>

                    
                    </section>
                  
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>

    </div>
@endsection

@section('javascript')
    <script>
        let colors = ['#7cb5ec', '#75b2a3', '#9ebfcc', '#acdda8', '#d7f4d2', '#ccf2e8',
            '#468499', '#088da5', '#00ced1', '#3399ff', '#00ff7f',
            '#b4eeb4', '#a0db8e', '#999999', '#6897bb', '#0099cc', '#3b5998',
            '#000080', '#191970', '#8a2be2', '#31698a', '#87ff8a', '#49e334',
            '#13ec30', '#7faf7a', '#408055', '#09790e'
        ]
        // angular.controller('dashboardCtrl', function ($scope, $http, httpService) {
        let datas = @json($data['ranking']);
        let labels = [];
        let dataSeriesNiali = [];
        let dataSeries = [];
        for (let i = 0; i < datas.length; i++) {
            const element = datas[i];
            labels.push(element.alternatif)
            dataSeries.push(parseFloat(element.ranking))
            dataSeriesNiali.push(parseFloat(element.total))
        }

        var ctx = document.getElementById('myChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',

            data: {
                labels: labels,
                datasets: [{
                    label: 'Ranking',
                    data: dataSeries,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },

                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                maintainAspectRatio: false,
            }
        });

        var ctxs = document.getElementById('chartNilai').getContext('2d');

        var myCharts = new Chart(ctxs, {
            type: 'pie',

            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai Alternatif',
                    data: dataSeriesNiali,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },

                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                maintainAspectRatio: false,
            }
        });
        // });
    </script>
@endsection
