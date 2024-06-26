<!DOCTYPE html>
<html>

<head>
    {{-- <title>Laporan Realisasi Sub Kegiatan</title> --}}
</head>

<body>
    {{-- {{ asset('assets/logo/logomelawi.png') }} --}}
    <table style="width:98%;border-collapse: collapse;" border="0" align="center">
        <tr>
            <td style="text-align:right; width:10%; height:10%;">
                <img src="{{ 'assets/logo/ctk_logomelawi.png' }}" width="80px" height="80px">
            </td>
            <td style="width:60%;">
                <table style="width:80%;border-collapse: collapse;" border="0">
                    <tr>
                        <td height="40" colspan="3" style="text-align:center;font-size:16px"><b>PEMERINTAH
                                KABUPATEN MELAWI</b>
                        </td>

                    </tr>
                    <tr>
                        <td height="25" colspan="3" style="text-align:center;font-size:16px">{{ $judul->judul }}
                        </td>
                    </tr>
                    <tr>
                        <td height="25" colspan="3" style="text-align:center;font-size:16px">Periode
                            {{ tgl_format_indonesia(ucwords($periode1)) }}
                            s.d {{ tgl_format_indonesia(ucwords($periode2)) }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table style="width:98%;border-collapse: collapse;font-size:12px" align="center" border="1">
        <thead style="display: table-header-group;">
            <tr>
                <th style="text-align:center; width:6%;">No</th>
                <th style="text-align:center; width:16%;">Nama SKPD</th>
                <th style="text-align:center; width:14%;">Nama Bidang Urusan</th>
                <th style="text-align:center; width:14%;">Nama Program</th>
                <th style="text-align:center;width:15%;">Nama Kegiatan</th>
                <th style="text-align:center;width:15%;">Nama Sub Kegiatan</th>
                <th style="text-align:center;width:10%;">Anggaran</th>
                <th style="text-align:center;width:10%;">Realisasi</th>
                {{-- <th style="text-align:center;width:10%;">Total</th> --}}
            </tr>
        </thead>
        @php
            $tot_anggaran = 0;
            $tot_realisasi = 0;
            $data;
            $jml_data;
            $jml_data = count((array) $hasilsub);

            $hasilll;
        @endphp
        @foreach ($hasilsub as $hasilsubs)
            @php
                $tot_anggaran += $hasilsubs->anggaran;
                $tot_realisasi += $hasilsubs->realisasi;
                $data[] = ['kd_skpd' => $hasilsubs->kd_skpd, 'nm_skpd' => $hasilsubs->nm_skpd, 'nm_bidang_urusan' => $hasilsubs->nm_bidang_urusan, 'nm_program' => $hasilsubs->nm_program, 'nm_kegiatan' => $hasilsubs->nm_kegiatan, 'nm_sub_kegiatan' => $hasilsubs->nm_sub_kegiatan, 'anggaran' => $hasilsubs->anggaran, 'realisasi' => $hasilsubs->realisasi];

            @endphp
        @endforeach
        @php
            $pengurangan = $jml_data - $jmldata;
            $nomor = 0;
            // var_dump($data);
        @endphp
        @for ($i = 0; $i < $pengurangan; $i++)
            <tr>
                <td style="text-align:center;">{{ $nomor + 1 }}</td>
                <td style="padding-left:10px;">{{ $data[$i]['nm_skpd'] }}</td>
                <td style="padding-left:10px;">{{ $data[$i]['nm_bidang_urusan'] }}</td>
                <td style="padding-left:10px;">{{ $data[$i]['nm_program'] }}</td>
                <td style="padding-left:10px;">{{ $data[$i]['nm_kegiatan'] }}</td>
                <td style="padding-left:10px;">{{ $data[$i]['nm_sub_kegiatan'] }}</td>
                <td style="padding-left:10px;">{{ number_format($data[$i]['anggaran'], 2, ',', '.') }}</td>
                <td style="padding-left:10px;">{{ number_format($data[$i]['realisasi'], 2, ',', '.') }}</td>
                {{-- <td rowspan="1" style="padding-left:10px;"></td> --}}
            </tr>
            @php
                $nomor++;
            @endphp
        @endfor
    </table>

</body>

</html>
