<!DOCTYPE html>
<html>

<head>
    <title>Laporan Realisasi Sub Kegiatan</title>
    {{-- <style type="text/css" media="print">
        div.page {
            page-break-after: always;

        }
    </style> --}}
</head>

<body>
    {{-- {{ asset('assets/logo/logomelawi.png') }} --}}
    <table style="width:98%;border-collapse: collapse;font-family:Times New Roman;" border="0" align="center">
        <tr>
            <td colspan="2" style="text-align:right; width:15%; height:10%;">
                <img src="{{ asset('assets/logo/ctk_logomelawi.png') }}" width="80px" height="80px">
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
    <table style="width:98%;border-collapse: collapse;font-size:12px;font-family:Times New Roman;" align="center"
        border="1">
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
        <tbody>
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
                    $sisa = $nomor;
                @endphp
            @endfor
            @for ($i = $sisa; $i < $jml_data;)
                <tr>
                    <td style="text-align:center;">{{ $i + 1 }}</td>
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
                    $i++;
                @endphp
            @endfor
            <tr>
                <td style="text-align:center;" colspan="6">TOTAL</td>
                <td style="text-align:center;">{{ number_format($tot_anggaran, 2, ',', '.') }}</td>
                <td style="text-align:center;">{{ number_format($tot_realisasi, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table style="width:98%;border-collapse: collapse;font-family:Times New Roman;" border="0">
        <tr>
            <td style="padding-left:80%;font-size:large">Nanga Pinoh, {{ tgl_format_indonesia(ucwords($tglttd)) }}
            </td>
        </tr>
        <tr>
            <td style="padding-left:80%;font-size:large">{{ $tandatangan->jabatan }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:large">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:large">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:large">&nbsp;</td>
        </tr>
        <tr>
            <td style="padding-left:80%;font-size:large"><u>{{ $tandatangan->nama }}</u></td>
        </tr>
        <tr>
            <td style="padding-left:80%;font-size:large">{{ $tandatangan->pangkat }}</td>
        </tr>
        <tr>
            <td style="padding-left:80%;font-size:large">NIP: {{ $tandatangan->nip }}</td>
        </tr>
    </table>
</body>

</html>
