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
                            <h3 class="card-title">Nilai Alternatif</h3>
                        </div>
                        <form action="{!! route('saveNilaiAlternatif') !!}" method="post">
                            {{csrf_field()}}

                            <input type="hidden" class="form-control" id="id" name="id"
                                   value="{!! $edit != null? $edit->id : '' !!}">
                            <div class="card-body">
                              
                                <div class="form-group">
                                    <label>Nama Alternatif</label>
                                    <select name="alternatiffk" id="alternatiffk" class="form-control" required>
                                        <option value="">-- Pilih Alternatif--</option>
                                        @foreach ($listAlternatif as $s) {
                                            <option {!! $edit != null && $edit->alternatiffk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->alternatif }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Character</label>
                                    <select name="characterfk" id="characterfk" class="form-control" required>
                                        <option value="">-- Pilih Character--</option>
                                        @foreach ($listCharacter as $s) {
                                            <option {!! $edit != null && $edit->characterfk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Capacity</label>
                                    <select name="capacityfk" id="capacityfk" class="form-control" required>
                                        <option value="">-- Pilih Capacity--</option>
                                        @foreach ($listCapacity as $s) {
                                            <option {!! $edit != null && $edit->capacityfk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Capital</label>
                                    <select name="capitalfk" id="capitalfk" class="form-control" required>
                                        <option value="">-- Pilih Capital--</option>
                                        @foreach ($listCapital as $s) {
                                            <option {!! $edit != null && $edit->capitalfk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Collateral</label>
                                    <select name="collateralfk" id="collateralfk" class="form-control" required>
                                        <option value="">-- Pilih Collateral--</option>
                                        @foreach ($listCollateral as $s) {
                                            <option {!! $edit != null && $edit->collateralfk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Condition</label>
                                    <select name="conditionfk" id="conditionfk" class="form-control" required>
                                        <option value="">-- Pilih Condition--</option>
                                        @foreach ($listCondition as $s) {
                                            <option {!! $edit != null && $edit->conditionfk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Cashflow</label>
                                    <select name="cashflowfk" id="cashflowfk" class="form-control" required>
                                        <option value="">-- Pilih Cashflow--</option>
                                        @foreach ($listCashflow as $s) {
                                            <option {!! $edit != null && $edit->cashflowfk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Culture</label>
                                    <select name="culturefk" id="culturefk" class="form-control" required>
                                        <option value="">-- Pilih Culture--</option>
                                        @foreach ($listCulture as $s) {
                                            <option {!! $edit != null && $edit->culturefk == $s->kode ? 'selected' : '' !!} value="{{ $s->kode }}">{{ $s->keterangan }}</option>
                                        @endforeach
                                    </select>
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
