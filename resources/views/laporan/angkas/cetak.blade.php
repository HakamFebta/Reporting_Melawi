<!DOCTYPE html>
<html>

<head>
    <title>Anggaran Kas</title>
</head>

<body>
    <table style="width:70%;border-collapse: collapse;" border="0" align="center">
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

                </table>
            </td>
        </tr>
    </table>
    <br>
    <table style="width:70%;border-collapse: collapse;" border="1" align="center">
        <tr>
            <th style="text-align:center; width:8%;">No</th>
            <th style="text-align:center; width:82%;">Nama SKPD</th>
            <th style="text-align:center; width:10%;">status</th>
        </tr>

        @foreach ($hasil as $key => $hasils)
            @if ($hasils->nilai == '1')
                @php
                    $icon = 'Sah';
                @endphp
            @else
                @php
                    $icon = 'Belum Sah';
                @endphp
            @endif
            <tr>
                <td>{{ $key + 1 }}</td>
                <td style="padding-left:10px;">{{ $hasils->nm_skpd }}</td>
                <td style="text-align:center;">{{ $icon }}</td>
            </tr>
        @endforeach
    </table>
</body>
