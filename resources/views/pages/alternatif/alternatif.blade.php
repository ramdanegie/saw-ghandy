@extends('template.main')
@section('css')
    <style>

    </style>
@endsection

@section('content-body')

    <div>



        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="padding: 10px">
                        <!-- DIRECT CHAT SUCCESS -->
                        <div class="card card-success card-outline direct-chat direct-chat-success shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">Alternatif</h3>
                                <div class="card-tools">
                                    {{--                                    <span title="3 New Messages" class="badge bg-success">3</span>--}}
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
                                    <div class="col-md-12 ">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" cellpadding="0"
                                                   width="100%"
                                                   id="tbl_Kriteria" style="font-size:small">
                                                <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode</th>
                                                    <th>Nama Alternatif</th>
                                                    <th>Keterangan</th>
                                                    <th>#</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($data as $i => $d)
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $d->kode }}</td>
                                                        <td>{{ $d->alternatif }}</td>
                                                        <td>{{ $d->keterangan }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-warning btn-sm editData"
                                                               data-selected="{{ json_encode($d, true)}}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button"
                                                                    class="btn btn-danger btn-sm hapusData"
                                                                    data-selected="{{ json_encode($d, true)}}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                    </tr>
                                                @empty
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-1">
                                        <button type="button" class="btn btn-success btn-block" style="width: 100%"
                                                onclick="tambah()">
                                            <i class="fas fa-plus"></i> Tambah
                                        </button>
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

        function tambah() {
            window.location.href = "{!! route("getAlternatif") !!}?tambah=true"
        }

        $('.editData').on('click', function (e) {
            e.preventDefault();
            var data = $(this).attr('data-selected');
            var json = JSON.parse(data)

            let newUrl = "{!! route("getAlternatif") !!}?kode=" + json.kode
            window.location.href = newUrl
        })
        $('.hapusData').on('click', function (e) {
            e.preventDefault();
            var data = $(this).attr('data-selected');
            var json = JSON.parse(data)
            if (confirm('Yakin mau hapus?')) {
                $.ajax({
                    type: 'POST',
                    url: baseUrl + '/saw/delete-all',
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "kode": json.kode,
                        "table": 'alternatif'
                    },
                    success: function (respond) {

                        if (respond == 'true') {
                            window.location.href = "{!! route("show_page", ["role" => $_SESSION['role'], "pages" => 'alternatif' ]) !!}"
                        }else{
                            toastr.error('Gagal Hapus')
                        }
                    }
                })
            }
        })

        // });
    </script>
@endsection
