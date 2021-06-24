@extends('template.main')
@section('css')
    <style>

    </style>
@endsection

@section('content-body')

    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="padding: 10px">
                    <div class="col-md-2">
                    </div>
                    <div class="col-12 col-md-8">
                        <!-- DIRECT CHAT SUCCESS -->
                        <div class="card card-success card-outline direct-chat direct-chat-success shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Perhitungan </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="row" style="padding: 50px">
                                    <div class="container">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading"><strong>Hasil Analisa</strong></div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Character</th>
                                                            <th>Capacity</th>
                                                            <th>Capital</th>
                                                            <th>Collateral</th>
                                                            <th>Condition</th>
                                                            <th>Cashflow</th>
                                                            <th>Culture</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($pendaftar as $i => $pen)
                                                        <tr>
                                                            <td>{!! $pen->alternatif !!}</td>
                                                            <td>{!! $pen->character !!}</td>
                                                            <td>{!! $pen->capacity !!}</td>
                                                            <td>{!! $pen->capital !!}</td>
                                                            <td>{!! $pen->collateral !!}</td>
                                                            <td>{!! $pen->condition !!}</td>
                                                            <td>{!! $pen->cashflow !!}</td>
                                                            <td>{!! $pen->culture !!}</td>
                                                        </tr>
                                                        @empty
                                                        @endforelse
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="panel-body"></div>
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>#</th>
                                                        @forelse($listKriteria as $i => $kri)
                                                           <th>{!! $kri->kode !!}</th>
                                                        @empty
                                                        @endforelse
                                                    </tr>
                                                    @forelse($pendaftar as $i => $pen)
                                                    <tr>
                                                        <th>{!! $pen->kode !!}</th>
                                                        <td>{!! $pen->n_character !!}</td>
                                                        <td>{!! $pen->n_capacity !!}</td>
                                                        <td>{!! $pen->n_capital !!}</td>
                                                        <td>{!! $pen->n_collateral !!}</td>
                                                        <td>{!! $pen->n_condition !!}</td>
                                                        <td>{!! $pen->n_cashflow !!}</td>
                                                        <td>{!! $pen->n_culture !!}</td>
                                                    </tr>
                                                    @empty
                                                    @endforelse
                                                   
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="panel panel-primary">
                                            <div class="panel-heading"><strong>Normalisasi</strong></div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <th></th>
                                                            @forelse($listKriteria as $i => $kri)
                                                               <th>{!! $kri->kode !!}</th>
                                                            @empty
                                                            @endforelse
                                                        </tr>
                                                        @forelse($pendaftar as $i => $pen)
                                                        <tr>
                                                            <th>{!! $pen->kode !!}</th>
                                                            <td>{!! (float)number_format((float) $pen->normal_character, 2, '.', '') !!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_capacity , 2, '.', '')!!}</td>
                                                            <td>{!! (float) number_format((float)$pen->normal_capital , 2, '.', '')!!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_collateral , 2, '.', '')!!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_condition, 2, '.', '') !!}</td>
                                                            <td>{!! (float) number_format((float) $pen->normal_cashflow, 2, '.', '') !!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_culture , 2, '.', '')!!}</td>
                                                        </tr>
                                                        @empty
                                                        @endforelse
                                                 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading"><strong>Perangkingan</strong></div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <th></th>
                                                            @forelse($listKriteria as $i => $kri)
                                                                <th>{!! $kri->kriteria !!}</th>
                                                            @empty
                                                            @endforelse
                                                            <th>Total</th>
                                                            <th>Rank</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Bobot</th>
                                                            @forelse($listKriteria as $i => $kri)
                                                                <td class="text-primary">{!! $kri->bobot !!}</td>
                                                            @empty
                                                            @endforelse
                                                            
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        @php
                                                   
                                                        @endphp
                                                        @forelse($pendaftar as $i => $pen)
                                                        <tr>
                                                            <th>{!! $pen->alternatif !!}</th>
                                                            <td>{!! (float)number_format((float)$pen->normal_character, 2, '.', '') !!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_capacity , 2, '.', '')!!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_capital , 2, '.', '')!!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_collateral , 2, '.', '')!!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_condition, 2, '.', '') !!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_cashflow, 2, '.', '') !!}</td>
                                                            <td>{!! (float)number_format((float)$pen->normal_culture , 2, '.', '')!!}</td>
                                                            <td class="text-primary">
                                                                {!! 
                                                               (float)number_format((float) $pen->total, 2, '.', '' )!!}</td>
                                                          
                                                            <td class="text-primary">{{ $pen->ranking}}</td>
                                                        </tr>
                                                        @empty
                                                        @endforelse

                         
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <a class="btn btn-default" target="_blank"
                                                        href="{!! route("show_page", ["role" => $_SESSION['role'], "pages" => 'cetak-perhitungan' ]) !!}"><span
                                                            class="fa fa-print" ></span> Cetak</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('javascript')
    <script>
        // angular.controller('kriteriaCtrl', function ($scope, $http, httpService) {
        $("#tbl_Kriteria").dataTable()



        // });

    </script>
@endsection
