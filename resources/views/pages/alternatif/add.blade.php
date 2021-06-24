@extends('template.main')
@section('css')
    <style>

    </style>
@endsection

@section('content-body')
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="padding: 10px">
                <div class="col-md-2">
                </div>
                <div class="col-12 col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Alternatif</h3>
                        </div>
                        <form action="{!! route('saveAlternatif') !!}" method="post">
                            {{csrf_field()}}

                            <input type="hidden" class="form-control" id="kode" name="kode"
                                   value="{!! $edit != null? $edit->kode : '' !!}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Alternatif </label>
                                    <input type="text" class="form-control" id="alternatif" name="alternatif"
                                           placeholder="Nama Alternatif"  value="{!! $edit != null? $edit->alternatif : '' !!}" required>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan </label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                                           placeholder="Keterangan"  value="{!! $edit != null? $edit->keterangan : '' !!}" required>
                                </div>
                            
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan
                                </button>
                                <button type="button" class="btn btn-warning" id="batal"><i class="fas fa-backward"></i>
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script>


            $("#batal").click(function () {
                window.history.back()
            });


    </script>
@endsection
