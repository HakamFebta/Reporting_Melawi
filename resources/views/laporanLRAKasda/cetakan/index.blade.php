<!DOCTYPE html>
<html>

<head>
    <title>Laporan Realisasi</title>
</head>

<body>
    {{-- {{ asset('assets/logo/logomelawi.png') }} --}}
    <table style="width:98%;border-collapse: collapse;" border="0" align="center">
        <tr>
            <td colspan="2" style="text-align:right; width:15%; height:10%;">
                <img src="{{ asset('assets/logo/ctk_logomelawi.png') }}" width="80px" height="80px">
            </td>
            <td style="width:60%;">
                <table style="width:80%;border-collapse: collapse;" border="0">
                    <tr>
                        <td height="40" colspan="3" style="text-align:center;font-size:22px;"><b>PEMERINTAH
                                KABUPATEN MELAWI</b>
                        </td>
                    </tr>
                    <tr>
                        <td height="25" colspan="3" style="text-align:center;font-size:18px;">Periode
                            {{ tgl_format_indonesia(ucwords($periode1)) }}
                            s.d {{ tgl_format_indonesia(ucwords($periode2)) }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table style="width:98%;border-collapse: collapse;font-size:18px;" align="center" border="1">
        <tr>
            {{-- <th style="text-align:center; width:8%;">No</th> --}}
            <th style="text-align:center; width:20%;background-color:powderblue;">Nama SKPD</th>
            <th style="text-align:center; width:8%;background-color:powderblue;">Kode Rekening</th>
            <th style="text-align:center;width:25%;background-color:powderblue;">Nama Rekening</th>
            <th style="text-align:center;width:15%;background-color:powderblue;">Anggaran</th>
            <th style="text-align:center;width:15%;background-color:powderblue;">Realisasi</th>
            <th style="text-align:center;width:5%;background-color:powderblue;">Presentase</th>
        </tr>
        <tr>
            {{-- <th style="text-align:center; width:8%;">No</th> --}}
            <th style="text-align:center; width:20%;background-color:powderblue;">1</th>
            <th style="text-align:center; width:8%;background-color:powderblue;">2</th>
            <th style="text-align:center;width:25%;background-color:powderblue;">3</th>
            <th style="text-align:center;width:15%;background-color:powderblue;">4</th>
            <th style="text-align:center;width:15%;background-color:powderblue;">5</th>
            <th style="text-align:center;width:5    %;background-color:powderblue;">6</th>
        </tr>
        @php
            $tot_anggaran = 0;
            $tot_realisasi = 0;
            $presentase = 0;
        @endphp
        @foreach ($hasilsub as $sub)
            @php

                $tot_anggaran += $sub->anggaran;
                $tot_realisasi += $sub->realisasi;
                if ($sub->anggaran != 0) {
                    $presentase = ($sub->realisasi / $sub->anggaran) * 100;
                } else {
                    $presentase = 0;
                }

            @endphp
            <tr>
                {{-- <td style="text-align:center;">{{ $loop->iteration }}</td> --}}
                <td style="padding-left:10px;">{{ $sub->nm_skpd }}</td>
                @if ($sub->kd_rek3 == '51' || $sub->kd_rek3 == '52')
                    <td style="padding-left:10px;font-weight: bold;">{{ $sub->kd_rek3 }}</td>
                    <td style="padding-left:10px;font-weight: bold;">{{ $sub->nm_rek3 }}</td>
                @else
                    <td style="padding-left:10px;">{{ $sub->kd_rek3 }}</td>
                    <td style="padding-left:10px;">{{ $sub->nm_rek3 }}</td>
                @endif
                <td style="padding-left:10px;">{{ number_format($sub->anggaran, 2, ',', '.') }}</td>
                <td style="padding-left:10px;">{{ number_format($sub->realisasi, 2, ',', '.') }}
                <td style="padding-left:10px;">{{ number_format($presentase, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
