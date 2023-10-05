<!DOCTYPE html>
<html>

<head>
    <title>Laporan Realisasi Sub Urusan</title>
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
                        <td height="40" colspan="3" style="text-align:center;font-size:large"><b>PEMERINTAH
                                KABUPATEN MELAWI</b>
                        </td>

                    </tr>
                    <tr>
                        <td height="25" colspan="3" style="text-align:center;font-size:large">{{ $judul->judul }}
                        </td>
                    </tr>
                    <tr>
                        <td height="25" colspan="3" style="text-align:center;font-size:large">Periode
                            {{ tgl_format_indonesia(ucwords($periode1)) }}
                            s.d {{ tgl_format_indonesia(ucwords($periode2)) }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table style="width:98%;border-collapse: collapse;font-size:medium" align="center" border="1">
        <tr>
            <td style="text-align:center; width:10%;">No</td>
            <td style="text-align:center; width:20%;">Nama SKPD</td>
            <td style="text-align:center; width:10%;">Nama Urusan</td>
            <td style="text-align:center; width:10%;">Nama Bidang Urusan</td>
            <td style="text-align:center; width:10%;">Nama Program</td>
            <td style="text-align:center; width:10%;">Nama Kegiatan</td>
            <td style="text-align:center;width:10%;">Nama Sub Kegiatan</td>
            <td style="text-align:center;width:10%;">Anggaran</td>
            <td style="text-align:center;width:10%;">Realisasi</td>
        </tr>
        @foreach ($hasilsub as $hasilsub)
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td style="padding-left:10px;">{{ $hasilsub->nm_skpd }}</td>
                <td style="padding-left:10px;">{{ $hasilsub->nm_urusan }}</td>
                <td style="padding-left:10px;">{{ $hasilsub->nm_bidang_urusan }}</td>
                <td style="padding-left:10px;">{{ $hasilsub->nm_program }}</td>
                <td style="padding-left:10px;">{{ $hasilsub->nm_kegiatan }}</td>
                <td style="padding-left:10px;">{{ $hasilsub->nm_sub_kegiatan }}</td>
                <td style="padding-left:10px;">{{ number_format($hasilsub->anggaran, 2, ',', '.') }}</td>
                <td style="padding-left:10px;">{{ number_format($hasilsub->realisasi, 2, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </table>
    <br>

    <table style="width:98%;border-collapse: collapse;" border="0">
        <tr>
            <td style="padding-left:80%;font-size:large">Nanga Pinoh, {{ tgl_format_indonesia(ucwords($tglttd)) }}
            </td>
        </tr>
        {{-- <tr>
            <td style="padding-left:80%;font-size:large">&nbsp;</td>
        </tr> --}}
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
