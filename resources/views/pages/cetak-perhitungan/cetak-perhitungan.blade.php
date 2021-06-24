<html>

<head>
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 13px;
        }

        h1 {
            font-size: 14px;
            border-bottom: 4px double #000;
            padding: 3px 0;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 3px;
        }

        .wrapper {
            margin: 0 auto;
            width: 980px;
        }

    </style>
</head>

<body onload="window.print()">
    <div class="wrapper">
        <h1>Perhitungan</h1>

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
                @forelse($perhitungan as $i => $pen)
                    <tr>
                        <th>{!! $pen->alternatif !!}</th>
                        <td>{!! (float) number_format((float) $pen->normal_character, 2, '.', '') !!}</td>
                        <td>{!! (float) number_format((float) $pen->normal_capacity, 2, '.', '') !!}</td>
                        <td>{!! (float) number_format((float) $pen->normal_capital, 2, '.', '') !!}</td>
                        <td>{!! (float) number_format((float) $pen->normal_collateral, 2, '.', '') !!}</td>
                        <td>{!! (float) number_format((float) $pen->normal_condition, 2, '.', '') !!}</td>
                        <td>{!! (float) number_format((float) $pen->normal_cashflow, 2, '.', '') !!}</td>
                        <td>{!! (float) number_format((float) $pen->normal_culture, 2, '.', '') !!}</td>
                        <td class="text-primary">
                            {!! (float) number_format((float) $pen->total, 2, '.', '') !!}</td>

                        <td class="text-primary">{{ $pen->ranking }}</td>
                    </tr>
                @empty
                @endforelse


            </tbody>
        </table>
    </div>

</body>

</html>
