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
                            <h3 class="card-title">Kriteria</h3>
                        </div>
                        <form action="{!! route('saveKriteria') !!}" method="post">
                            {{csrf_field()}}

                            <input type="hidden" class="form-control" id="kode" name="kode"
                                   value="{!! $edit != null? $edit->kode : '' !!}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Kriteria</label>
                                    <input type="text" class="form-control" id="kriteria" name="kriteria"
                                           placeholder="Nama Kriteria"  value="{!! $edit != null? $edit->kriteria : '' !!}" required>
                                </div>
                                <div class="form-group">
                                    <label>Attribut</label>
                                    <select name="atribut" id="atribut" class="form-control" required>
                                        <option value="">-- Pilih Attribut--</option>
                                        @foreach ($listAtribut as $s) {
                                            <option {!! $edit != null && $edit->atribut == $s['name'] ? 'selected' : '' !!} value="{{ $s['name'] }}">{{ $s['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Bobot</label>
                                    <input type="number" class="form-control" id="bobot" name="bobot"
                                           placeholder="Bobot"  value="{!! $edit != null? $edit->bobot : '' !!}" required>
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
