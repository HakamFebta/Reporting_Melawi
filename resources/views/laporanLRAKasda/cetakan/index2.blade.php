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
            <th style="text-align:center;width:5%;background-color:#cbd5e1">No</th>
            <th style="text-align:center;width:20%;background-color:#cbd5e1">Nama SKPD</th>
            <th style="text-align:center;width:8%;background-color:#cbd5e1">Kode Rekening</th>
            <th style="text-align:center;width:25%;background-color:#cbd5e1">Nama Rekening</th>
            <th style="text-align:center;width:15%;background-color:#cbd5e1">Anggaran</th>
            <th style="text-align:center;width:15%;background-color:#cbd5e1">Realisasi</th>
            <th style="text-align:center;width:5%;background-color:#cbd5e1">Presentase / %</th>
        </tr>
        <tr>
            <th style="text-align:center;width:5%;background-color:#cbd5e1">1</th>
            <th style="text-align:center;width:20%;background-color:#cbd5e1">2</th>
            <th style="text-align:center;width:8%;background-color:#cbd5e1">3</th>
            <th style="text-align:center;width:25%;background-color:#cbd5e1">4</th>
            <th style="text-align:center;width:15%;background-color:#cbd5e1">5</th>
            <th style="text-align:center;width:15%;background-color:#cbd5e1">6</th>
            <th style="text-align:center;width:5%;background-color:#cbd5e1">7</th>
        </tr>
        @php
            $tot_anggaran = 0;
            $tot_realisasi = 0;
            $presentase = 0;
            $isTrue = true;
            $skpd = '';
        @endphp

        @foreach ($hasilsub as $key => $sub)
            @foreach ($sub as $k => $item)
                @php
                    if ($item->anggaran != 0) {
                        $presentase = ($item->realisasi / $item->anggaran) * 100;
                    } else {
                        $presentase = 0;
                    }
                @endphp
                <tr>
                    @if ($loop->first)
                        <td style="text-align:center;" rowspan="{{ count($sub) }}">
                            {{ $loop->parent->iteration }}
                        </td>
                        <td style="padding-left:10px;border: 1px solid #000;" rowspan="{{ count($sub) }}">
                            {{ $key }}</td>
                    @endif
                    <td style="padding-left:10px;">{{ $item->kd_rek3 }}</td>
                    <td style="padding-left:10px;">{{ $item->nm_rek3 }}</td>
                    <td style="padding-left:10px;">{{ number_format($item->anggaran, 2, ',', '.') }}</td>
                    <td style="padding-left:10px;">{{ number_format($item->realisasi, 2, ',', '.') }}</td>
                    <td style="padding-left:10px;">{{ number_format($presentase, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
</body>

</html>

public function laporanlrakasda(Request $request)
{
$data = $request->all();
$data_Skpd = $data['skpd'];
if ($data['skpd'] == 'all') {
$skpd = '';
} else {
$skpd = "WHERE a.kd_skpd ='$data_Skpd'";
}
$status_sistem = dashboard_tahun()->getData();
$each_contribute = json_decode($data['rincian_data'], true);
$rinciansub = "'" . implode("','", $each_contribute) . "'";

$hasilSub = collect(DB::connection($status_sistem->con_sistem_kedua)->select("SELECT a.kd_skpd, a.nm_skpd,
a.kd_rek3,a.nm_rek3, SUM(ISNULL(a.anggaran,0)) as anggaran,SUM(ISNULL(b.realisasi,0)) as realisasi FROM (SELECT
x.kd_skpd, x.nm_skpd,x.kd_sub_kegiatan,x.kd_rek3, x.nm_rek3,x.kd_rek6, SUM(x.total) as anggaran FROM (SELECT (SELECT
nm_skpd FROM ms_skpd WHERE kd_skpd=a.kd_skpd) as nm_skpd, a.kd_skpd, b.kd_rek2 as kd_rek3, b.nm_rek2 as
nm_rek3,a.kd_sub_kegiatan,a.kd_rek6, a.nilai as total FROM trdrka a INNER JOIN ms_rek2 b ON b.kd_rek2=LEFT(a.kd_rek6,2)
WHERE LEFT(a.kd_rek6,2) IN('51') AND a.jns_ang= ?
UNION ALL
SELECT (SELECT nm_skpd FROM ms_skpd WHERE kd_skpd=a.kd_skpd) as nm_skpd, a.kd_skpd, b.kd_rek2 as kd_rek3, b.nm_rek2 as
nm_rek3, a.kd_sub_kegiatan,a.kd_rek6,a.nilai as total FROM trdrka a INNER JOIN ms_rek2 b ON b.kd_rek2=LEFT(a.kd_rek6,2)
WHERE LEFT(a.kd_rek6,2) IN('52') AND a.jns_ang= ?
UNION ALL
SELECT (SELECT nm_skpd FROM ms_skpd WHERE kd_skpd=a.kd_skpd) as nm_skpd,a.kd_skpd,b.kd_rek3 as kd_rek3, b.nm_rek3 as
nm_rek3, a.kd_sub_kegiatan,a.kd_rek6, a.nilai as total FROM trdrka a INNER JOIN ms_rek3 b ON b.kd_rek3=LEFT(a.kd_rek6,4)
WHERE LEFT(a.kd_rek6,4) IN($rinciansub) AND a.jns_ang= ?)x GROUP BY x.nm_skpd,x.kd_rek3,
x.nm_rek3,x.kd_skpd,x.kd_sub_kegiatan,x.kd_rek6) a
LEFT JOIN (SELECT a.kd_unit,a.kd_sub_kegiatan, a.kd_rek6 as kd_rek6, CASE WHEN LEFT(a.kd_rek6,1)='5' THEN
ISNULL(SUM(a.debet-a.kredit),0) WHEN LEFT(a.kd_rek6,1)='4' THEN ISNULL(SUM(a.kredit-a.debet),0) ELSE 0 END as realisasi
FROM trdju_pkd a INNER JOIN trhju_pkd b ON b.no_voucher=a.no_voucher AND b.kd_skpd=a.kd_unit WHERE b.tgl_voucher BETWEEN
? AND ? GROUP BY a.kd_sub_kegiatan,a.kd_unit,a.kd_rek6) b ON b.kd_sub_kegiatan=a.kd_sub_kegiatan AND b.kd_unit=a.kd_skpd
AND b.kd_rek6=a.kd_rek6 $skpd GROUP BY a.kd_skpd,a.kd_rek3,a.nm_rek3,a.nm_skpd ORDER BY a.kd_skpd ASC,realisasi
DESC,a.kd_rek3", [$data['jns_ang'], $data['jns_ang'], $data['jns_ang'], $data['periode1'],
$data['periode2']]))->groupBy('nm_skpd');

$hasil = [
'hasilsub' => $hasilSub,
'periode1' => $data['periode1'],
'periode2' => $data['periode2'],
// 'tandatangan' => DB::connection($status_sistem->con_sistem_pertama)->table('master_ttd')
// ->where(['id_ttd' => $data['ttd']])->first(),
// 'tglttd' => $data['tglttd'],
// 'jmldata' => $data['jmldata'] == 0 || '' ? '0' : $data['jmldata'],
'gambar' => asset('assets/logo/ctk_logomelawi.png')
];

$judul = 'Laporan_Realisasi';
$view = view('laporanLRAKasda.cetakan.index', $hasil);
switch ($data['model_cetak']) {
case "layar":
return $view;
break;
case "pdf":
$pdf = SnappyPdf::loadHTML($view)
->setPaper('Legal', 'Landscape')
->setOption('margin-top', '10')
->setOption('margin-bottom', '20')
->setOption('margin-left', '12')
->setOption('margin-right', '10');
// ->setOption('font-html', 'Times New Roman');
$pdf->setOption('footer-right', "Reporting Melawi -- Page [page] of [toPage]");
return $pdf->stream('Laporan_Realisasi.pdf');
break;
case "excel":
header("Cache-Control: no-cache, no-store, must_revalidate");
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachement; filename="' . $judul . '.xls"');
return view('laporanLRAKasda.cetakan.index')->with($hasil);
break;
}
}
