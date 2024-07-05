<?php

namespace App\Http\Controllers\LRAKasda;

use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mpdf\Mpdf as PDFA;

class LRAKasdaController extends Controller
{
    public function index()
    {
        return view('laporanLRAKasda.index');
    }

    public function kasda_kode_skpd(Request $request)
    {
        $status_sistem = dashboard_tahun()->getData();
        $search = $request->input('term');
        if (isset($search)) {
            $data = DB::connection($status_sistem->con_sistem_kedua)->table('ms_skpd')->where(function ($query) use ($request) {
                $query->where('kd_skpd', 'like', '%' . $request->input('term') . '%')
                    ->orWhere('nm_skpd', 'like', '%' . $request->input('term') . '%');
            })->select('kd_skpd', 'nm_skpd')->get();
        } else {
            $data = DB::connection($status_sistem->con_sistem_kedua)->table('ms_skpd')->select('kd_skpd', 'nm_skpd')->get();
        }
        $hasil = [];
        $no = 0;
        foreach ($data as $value) {
            $hasil[] = [
                'id' => $no,
                'kode_skpd' => $value->kd_skpd,
                'text' => $value->kd_skpd . ' - ' . $value->nm_skpd
            ];
            $no++;
        };
        return response()->json(['hasil' => $hasil]);
    }

    public function kasda_jns_anggaran(Request $request)
    {
        $status_sistem = dashboard_tahun()->getData();
        $search = $request->input('term');
        if (isset($search)) {
            $data = DB::connection('sqlsrv')->table('ms_anggaran')->where(function ($query) use ($request) {
                $query->where('nama_anggaran', 'like', '%' . $request->input('term') . '%');
            })->select('jenis_anggaran', 'nama_anggaran')->where('status', '=', 1)->get();
        } else {
            $data = DB::connection('sqlsrv')->table('ms_anggaran')->select('jenis_anggaran', 'nama_anggaran')->where('status', '=', 1)->get();
        }
        $hasil = [];
        $no = 0;
        foreach ($data as $value) {
            $hasil[] = [
                'id' => $no,
                'jenis_anggaran' => $value->jenis_anggaran,
                'text' => $value->nama_anggaran
            ];
            $no++;
        };
        return response()->json(['hasil' => $hasil]);
    }

    public function kasda_rekening_belanja(Request $request)
    {
        $status_sistem = dashboard_tahun()->getData();
        $search = $request->input('term');
        if (isset($search)) {
            $data = DB::connection($status_sistem->con_sistem_kedua)->table('ms_rek3')->where(function ($query) use ($request) {
                $query->where('kd_rek3', 'like', '%' . $request->input('term') . '%')
                    ->orWhere('nm_rek3', 'like', '%' . $request->input('term') . '%');
            })->select('kd_rek3', 'nm_rek3', DB::raw('LEFT(kd_rek3,2) as kode_rek3'))->whereRaw('LEFT(kd_rek3,2) IN (?,?)', [51, 52])->get();
        } else {
            $data = DB::connection($status_sistem->con_sistem_kedua)->table('ms_rek3')->select('kd_rek3', 'nm_rek3', DB::raw('LEFT(kd_rek3,2) as kode_rek3'))->whereRaw('LEFT(kd_rek3,2) IN (?,?)', [51, 52])->get();
        }
        $hasil = [];
        $no = 0;
        foreach ($data as $value) {
            $hasil[] = [
                'id' => $no,
                'kd_rek3' => $value->kd_rek3,
                'text' => $value->kd_rek3 . ' - ' . $value->nm_rek3
            ];
            $no++;
        };
        return response()->json(['hasil' => $hasil]);
    }

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

        $hasil = [
            'hasilsub' => DB::connection($status_sistem->con_sistem_kedua)->select("SELECT a.kd_skpd, a.nm_skpd, a.kd_rek3,a.nm_rek3, SUM(ISNULL(a.anggaran,0)) as anggaran,SUM(ISNULL(b.realisasi,0)) as realisasi FROM (SELECT x.kd_skpd, x.nm_skpd,x.kd_sub_kegiatan,x.kd_rek3, x.nm_rek3,x.kd_rek6, SUM(x.total) as anggaran FROM (SELECT (SELECT nm_skpd FROM ms_skpd WHERE kd_skpd=a.kd_skpd) as nm_skpd, a.kd_skpd, b.kd_rek2 as kd_rek3, b.nm_rek2 as nm_rek3,a.kd_sub_kegiatan,a.kd_rek6, a.nilai as total FROM trdrka a INNER JOIN ms_rek2 b ON b.kd_rek2=LEFT(a.kd_rek6,2) WHERE LEFT(a.kd_rek6,2) IN('51') AND a.jns_ang= ?
            UNION ALL
            SELECT '' as nm_skpd, a.kd_skpd, b.kd_rek2 as kd_rek3, b.nm_rek2 as nm_rek3, a.kd_sub_kegiatan,a.kd_rek6,a.nilai as total FROM trdrka a INNER JOIN ms_rek2 b ON b.kd_rek2=LEFT(a.kd_rek6,2) WHERE LEFT(a.kd_rek6,2) IN('52') AND a.jns_ang= ?
            UNION ALL
            SELECT '' as nm_skpd,a.kd_skpd,b.kd_rek3 as kd_rek3, b.nm_rek3 as nm_rek3, a.kd_sub_kegiatan,a.kd_rek6, a.nilai as total FROM trdrka a INNER JOIN ms_rek3 b ON b.kd_rek3=LEFT(a.kd_rek6,4) WHERE LEFT(a.kd_rek6,4) IN($rinciansub) AND a.jns_ang= ?)x GROUP BY x.nm_skpd,x.kd_rek3, x.nm_rek3,x.kd_skpd,x.kd_sub_kegiatan,x.kd_rek6) a
            LEFT JOIN (SELECT a.kd_unit,a.kd_sub_kegiatan, a.kd_rek6 as kd_rek6, CASE WHEN LEFT(a.kd_rek6,1)='5' THEN ISNULL(SUM(a.debet-a.kredit),0) WHEN LEFT(a.kd_rek6,1)='4' THEN ISNULL(SUM(a.kredit-a.debet),0) ELSE 0 END as realisasi FROM trdju_pkd a INNER JOIN trhju_pkd b ON b.no_voucher=a.no_voucher AND b.kd_skpd=a.kd_unit WHERE b.tgl_voucher BETWEEN ? AND ? GROUP BY a.kd_sub_kegiatan,a.kd_unit,a.kd_rek6) b ON b.kd_sub_kegiatan=a.kd_sub_kegiatan AND b.kd_unit=a.kd_skpd AND b.kd_rek6=a.kd_rek6 $skpd GROUP BY a.kd_skpd,a.kd_rek3,a.nm_rek3,a.nm_skpd ORDER BY a.kd_skpd ASC,a.kd_rek3,realisasi DESC", [$data['jns_ang'], $data['jns_ang'], $data['jns_ang'], $data['periode1'], $data['periode2']]),
            'periode1' => $data['periode1'],
            'periode2' => $data['periode2'],
            // 'tandatangan' => DB::connection($status_sistem->con_sistem_pertama)->table('master_ttd')
            //     ->where(['id_ttd' => $data['ttd']])->first(),
            // 'tglttd' => $data['tglttd'],
            // 'jmldata' => $data['jmldata'] == 0 || '' ? '0' : $data['jmldata'],
            'gambar' =>  asset('assets/logo/ctk_logomelawi.png')
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
                    ->setOption('margin-bottom', '18')
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
}
