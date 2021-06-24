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
                            <h3 class="card-title">Nilai Crips</h3>
                        </div>
                        <form action="{!! route('saveNilaiCrips') !!}" method="post">
                            {{csrf_field()}}

                            <input type="hidden" class="form-control" id="kode" name="kode"
                                   value="{!! $edit != null? $edit->kode : '' !!}">
                            <div class="card-body">
                              
                                <div class="form-group">
                                    <label>Kriteria</label>
                                    <select name="kriteriafk" id="kriteriafk" class="form-control" required>
                                        <option value="">-- Pilih Kriteria--</option>
                                        @foreach ($listKriteria as $s) {
                                            <option {!! $edit != null && $edit->kriteriafk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->kriteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                                           placeholder="Nama"  value="{!! $edit != null? $edit->keterangan : '' !!}" required>
                                </div>
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <input type="number" class="form-control" id="nilai" name="nilai"
                                           placeholder="Nilai"  value="{!! $edit != null? $edit->nilai : '' !!}" required>
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
