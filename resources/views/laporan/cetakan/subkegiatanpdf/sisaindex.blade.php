<!DOCTYPE html>
<html>

<body>
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
        @endphp
        @for ($i = 0; $i < $pengurangan; $i++)
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
                <td style="padding-left:10px;"> {{ $data[$i]['nm_kegiatan'] }}</td>
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
    </table>
    <br>
    <table style="width:98%;border-collapse: collapse;" border="0">
        <tr>
            <td style="padding-left:70%;font-size:12px">Nanga Pinoh, {{ tgl_format_indonesia(ucwords($tglttd)) }}
            </td>
        </tr>
        <tr>
            <td style="padding-left:70%;font-size:12px">{{ $tandatangan->jabatan }}</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:12px">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:12px">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:center;font-size:12px">&nbsp;</td>
        </tr>
        <tr>
            <td style="padding-left:70%;font-size:14px"><u>{{ $tandatangan->nama }}</u></td>
        </tr>
        <tr>
            <td style="padding-left:70%;font-size:14px">{{ $tandatangan->pangkat }}</td>
        </tr>
        <tr>
            <td style="padding-left:70%;font-size:14px">NIP: {{ $tandatangan->nip }}</td>
        </tr>
    </table>
</body>

@php
@endphp
</body>

</html>
