<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Facade\FlareClient\Http\Response;
// use PDFF;
use \Mpdf\Mpdf as PDFA;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDFF;




class LaporanController extends Controller
{
    public function index()
    {
        $status_sistem = dashboard_tahun()->getData();
        $data = [
            'jns_anggaran' => DB::connection($status_sistem->con_sistem_kedua)->table('tb_status_anggaran')->select('kode', 'nama')
                ->where(['status_aktif' => '1'])->get(),
            'skpd' => DB::connection($status_sistem->con_sistem_kedua)->table('ms_skpd')->select('kd_skpd', 'nm_skpd')
                ->get(),
            'urusan' => DB::connection($status_sistem->con_sistem_kedua)->table('ms_urusan')->select('kd_urusan', 'nm_urusan')
                ->get(),
            'program' => DB::connection($status_sistem->con_sistem_kedua)->table('ms_program')->select('kd_program', 'nm_program')
                ->get(),
            'kegiatan' => DB::connection($status_sistem->con_sistem_kedua)->table('ms_kegiatan')->select('kd_kegiatan', 'nm_kegiatan')
                ->get(),
            'tandatangan' => DB::connection($status_sistem->con_sistem_pertama)->table('master_ttd')
                ->get(),
        ];
        return view('Laporan.laporanA')->with($data);
    }

    function listdata()
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $jenis = Auth::user()->jenis;
            $id_user = Auth::user()->id_user;
            if ($jenis == '1') {
                $data = DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')
                    ->select('no_transaksi', 'judul', 'jenis', 'id_user')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($row) use ($id_user) {
                        if ($row->id_user == $id_user) {
                            $btn = '<button type="button" style="margin-left:5px;margin-right:4px;" id="editdata"; class="btn btn-warning btn-sm buttonedit-laporan" title="Edit data" onclick="editdata(\'' . $row->no_transaksi . '\',\'' . $row->judul . '\',\'' . $row->jenis . '\')"/><i class="bx bx-pencil"></i></button>';
                            $btn .= '<button type="button" style="margin-right:4px;" class="btn btn-secondary btn-sm button-cetak" title="Cetak Laporan" onclick="cetak(\'' . $row->no_transaksi . '\',\'' . $row->judul . '\',\'' . $row->jenis . '\',\'' . $row->id_user . '\')"/><i class="bx bx-printer"></i></button>';
                            $btn .= '<button type="button" class="btn btn-danger btn-sm button-hapus" title="Hapus data" onclick="deletedata(\'' . $row->no_transaksi . '\',\'' . $row->jenis . '\')"/><i class="bx bxs-trash"></i></button>';
                        } else if ($row->id_user != $id_user) {
                            $btn = '<button type="button" style="margin-right:4px;" class="btn btn-secondary btn-sm button-cetak" title="Cetak Laporan" onclick="cetak(\'' . $row->no_transaksi . '\',\'' . $row->judul . '\',\'' . $row->jenis . '\',\'' . $row->id_user . '\')"/><i class="bx bx-printer"></i></button>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['aksi'])
                    ->toJson();
            } elseif ($jenis == '2') {
                $data = DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')
                    ->select('no_transaksi', 'judul', 'jenis', 'id_user')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($row) use ($id_user) {
                        if ($row->id_user == $id_user) {
                            $btn = '<button type="button" style="margin-left:5px;margin-right:4px;" id="editdata"; class="btn btn-warning btn-sm buttonedit-laporan" title="Edit data" onclick="editdata(\'' . $row->no_transaksi . '\',\'' . $row->judul . '\',\'' . $row->jenis . '\')"/><i class="bx bx-pencil"></i></button>';
                            $btn .= '<button type="button" style="margin-right:4px;" class="btn btn-secondary btn-sm button-cetak" title="Cetak Laporan" onclick="cetak(\'' . $row->no_transaksi . '\',\'' . $row->judul . '\',\'' . $row->jenis . '\',\'' . $row->id_user . '\')"/><i class="bx bx-printer"></i></button>';
                            $btn .= '<button type="button" class="btn btn-danger btn-sm button-hapus" title="Hapus data" onclick="deletedata(\'' . $row->no_transaksi . '\',\'' . $row->jenis . '\')"/><i class="bx bxs-trash"></i></button>';
                        } else if ($row->id_user != $id_user) {
                            $btn = '<button type="button" style="margin-right:4px;" class="btn btn-secondary btn-sm button-cetak" title="Cetak Laporan" onclick="cetak(\'' . $row->no_transaksi . '\',\'' . $row->judul . '\',\'' . $row->jenis . '\',\'' . $row->id_user . '\')"/><i class="bx bx-printer"></i></button>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['aksi'])
                    ->toJson();
            } elseif ($jenis == '3') {
                $data = DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')
                    ->select('no_transaksi', 'judul', 'jenis', 'id_user')
                    ->where(['id_user' => $id_user])
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($row) {
                        $btn = '<button type="button" style="margin-left:5px;margin-right:4px;" id="editdata"; class="btn btn-warning btn-sm buttonedit-laporan" title="Edit data" onclick="editdata(\'' . $row->no_transaksi . '\',\'' . $row->judul . '\',\'' . $row->jenis . '\')"/><i class="bx bx-pencil"></i></button>';
                        $btn .= '<button type="button" style="margin-right:4px;" class="btn btn-secondary btn-sm button-cetak" title="Cetak Laporan" onclick="cetak(\'' . $row->no_transaksi . '\',\'' . $row->judul . '\',\'' . $row->jenis . '\',\'' . $row->id_user . '\')"/><i class="bx bx-printer"></i></button>';
                        $btn .= '<button type="button" class="btn btn-danger btn-sm button-hapus" title="Hapus data" onclick="deletedata(\'' . $row->no_transaksi . '\',\'' . $row->jenis . '\')"/><i class="bx bxs-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['aksi'])
                    ->toJson();
            } else {
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function subkegiatan(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $skpd = $request->skpd;
            $jns_ang = $request->jns_ang;
            if (($skpd != '' || $skpd != null) && ($jns_ang != '' || $jns_ang != null)) {
                $subkegiatan = DB::connection($status_sistem->con_sistem_kedua)->select("SELECT kd_sub_kegiatan, nm_sub_kegiatan FROM trdrka WHERE kd_skpd = ? AND jns_ang = ? GROUP BY kd_sub_kegiatan, nm_sub_kegiatan", [$skpd, $jns_ang]);
            } else {
                $subkegiatan = DB::connection($status_sistem->con_sistem_kedua)->select("SELECT kd_sub_kegiatan, nm_sub_kegiatan FROM ms_sub_kegiatan");
            }
            return $subkegiatan;
        } catch (\Throwable $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function simpandata(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $data = $request->data;
            $username = Auth::user()->username;
            $id_user = Auth::user()->id_user;
            DB::beginTransaction();
            // DB::connection('sqlsrv')->statement(DB::raw('LOCK TABLES header_laporan WRITE'));
            DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')->raw('LOCK TABLES header_laporan WRITE');
            $nomorurut = DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')->select(DB::raw('ISNULL(MAX(no_transaksi),0)+1 as no_urut'))->where(['id_user' => $id_user])->first();
            DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')->insert([
                'no_transaksi' => $nomorurut->no_urut,
                'judul' => $data['judul'],
                'jenis' => $data['jenis'],
                'id_user' => $id_user,
                'username' => $username,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            if (isset($data['datatampungan'])) {
                DB::connection($status_sistem->con_sistem_pertama)->table('rincian_header_laporan')->insert(array_map(
                    function ($element) use ($nomorurut, $data, $id_user) {
                        return [
                            'no_transaksi' => $nomorurut->no_urut,
                            'kode_data' => $element['kd_data'],
                            'nama_data' => $element['nm_data'],
                            'jenis' => $data['jenis'],
                            'id_user' => $id_user,
                        ];
                    },
                    $data['datatampungan']
                ));
            }
            DB::commit();
            return response()->json(['pesan' => 'Berhasil simpan']);
        } catch (\Throwable $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function wherelist(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $data = $request->all();
            DB::beginTransaction();
            $hasil = [
                'listdata' => DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')->select('judul', 'jenis', 'no_transaksi', 'id_user')
                    ->where(['no_transaksi' => $data['no_transaksi'], 'jenis' => $data['jenis'], 'id_user' => $data['id_user']])->first(),
                'rinciandata' => DB::connection($status_sistem->con_sistem_pertama)->table('rincian_header_laporan')->select('no_transaksi', 'kode_data', 'nama_data', 'jenis')
                    ->where(['no_transaksi' => $data['no_transaksi'], 'jenis' => $data['jenis'], 'id_user' => $data['id_user']])->get(),
            ];
            DB::commit();
            return response()->json($hasil);
        } catch (\Throwable $th) {
            return response()->json(['pesan' => 'Gagal ambil']);
        }
    }

    function whereditdata(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $data = $request->all();
            $id_user = Auth::user()->id_user;
            DB::beginTransaction();
            $hasil = [
                'listdata' => DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')->select('judul', 'jenis', 'no_transaksi')
                    ->where(['no_transaksi' => $data['no_transaksi'], 'jenis' => $data['jenis'], 'id_user' => $id_user])->first(),
                'rinciandata' => DB::connection($status_sistem->con_sistem_pertama)->table('rincian_header_laporan')->select('no_transaksi', 'kode_data', 'nama_data', 'jenis')
                    ->where(['no_transaksi' => $data['no_transaksi'], 'jenis' => $data['jenis'], 'id_user' => $id_user])->get(),
            ];
            DB::commit();
            return response()->json($hasil);
        } catch (\Throwable $th) {
            return response()->json(['pesan' => 'Error']);
        }
    }
    // Cetakan data sub kegiatan
    function cetakdatasubkegiatan(Request $request)
    {
        // $data = $request->all();
        // // $jumlahdata = $data['jmldata'];
        // $jmldata = $data['jmldata'] == null || 0  ? '0' : $data['jmldata'];
        // try {
        $data = $request->all();
        $status_sistem = dashboard_tahun()->getData();
        $jmldata = $data['jmldata'] == null || 0  ? '0' : $data['jmldata'];
        $each_contribute = json_decode($data['rincian_data'], true);
        $rinciansub = "'" . implode("','", $each_contribute) . "'";

        $hasil = [
            'judul' => DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')
                ->select("judul")
                ->where(['no_transaksi' => $data['no_transaksi'], 'id_user' => $data['id_user']])->first(),
            'hasilsub' => DB::connection($status_sistem->con_sistem_kedua)->select("SELECT a.kd_skpd, (SELECT nm_skpd FROM ms_skpd WHERE kd_skpd=a.kd_skpd) as nm_skpd, a.nm_bidang_urusan,a.nm_program,a.nm_kegiatan, a.kd_sub_kegiatan, a.nm_sub_kegiatan, ISNULL(a.nilai,0) as anggaran,  ISNULL(b.realisasi,0) as realisasi FROM(
                SELECT a.kd_skpd, b.kd_bidang_urusan, b.nm_bidang_urusan, c.kd_program, c.nm_program, d.kd_kegiatan, d.nm_kegiatan,a.kd_sub_kegiatan, a.nm_sub_kegiatan,LEFT(a.kd_rek6,1) as kd_rek6, SUM(a.nilai) as nilai FROM trdrka a LEFT JOIN ms_bidang_urusan b ON b.kd_bidang_urusan=LEFT(a.kd_sub_kegiatan,4) LEFT JOIN ms_program c ON c.kd_program=LEFT(a.kd_sub_kegiatan,7) LEFT JOIN ms_kegiatan d ON d.kd_kegiatan=LEFT(a.kd_sub_kegiatan,12) WHERE a.jns_ang = ? AND a.kd_sub_kegiatan IN ($rinciansub) GROUP BY a.kd_sub_kegiatan,a.nm_sub_kegiatan,a.kd_skpd,LEFT(a.kd_rek6,1),b.kd_bidang_urusan, b.nm_bidang_urusan,c.kd_program, c.nm_program,d.kd_kegiatan, d.nm_kegiatan)a
                LEFT JOIN(SELECT a.kd_unit,a.kd_sub_kegiatan, LEFT(a.kd_rek6,1) as kd_rek6, CASE WHEN LEFT(a.kd_rek6,1)='5' THEN ISNULL(SUM(a.debet-a.kredit),0) WHEN LEFT(a.kd_rek6,1)='4' THEN ISNULL(SUM(a.kredit-a.debet),0) ELSE 0 END as realisasi FROM trdju_pkd a INNER JOIN trhju_pkd b ON b.no_voucher=a.no_voucher AND b.kd_skpd=a.kd_unit WHERE b.tgl_voucher BETWEEN ? AND ? GROUP BY a.kd_sub_kegiatan,a.kd_unit,LEFT(a.kd_rek6,1)) b ON b.kd_sub_kegiatan=a.kd_sub_kegiatan AND b.kd_unit=a.kd_skpd AND a.kd_rek6=b.kd_rek6 ORDER BY a.kd_skpd", [$data['jns_ang'], $data['periode1'], $data['periode2']]),
            'periode1' => $data['periode1'],
            'periode2' => $data['periode2'],
            'tandatangan' => DB::connection($status_sistem->con_sistem_pertama)->table('master_ttd')
                ->where(['id_ttd' => $data['ttd']])->first(),
            'tglttd' => $data['tglttd'],
            'jmldata' => $data['jmldata'] == 0 || '' ? '0' : $data['jmldata'],
            'gambar' =>  asset('assets/logo/ctk_logomelawi.png')
        ];

        $judul = 'Sub_Kegiatan';
        $view = view('laporan.cetakan.subkegiatan', $hasil);
        switch ($data['jns_cetak']) {
            case "layar":
                return $view;
                break;
            case "pdf":
                if ($jmldata == 0) {
                    $pdf = SnappyPdf::loadHTML($view)
                        ->setPaper('Legal', 'Landscape')
                        ->setOption('margin-top', '10')
                        ->setOption('margin-bottom', '18')
                        ->setOption('margin-left', '12')
                        ->setOption('margin-right', '10');
                    // ->setOption('font-html', 'Times New Roman');
                    $pdf->setOption('footer-right', "Reporting Melawi -- Page [page] of [toPage]");
                    return $pdf->stream('SubKegiatan.pdf');
                } else {
                    $mpdf = new PDFA([
                        'mode' => 'utf-8',
                        'format' => 'Legal',
                        'margin_top' => '10',
                        'margin_bottom' => '18',
                        'margin_left' => '12',
                        'margin_right' => '10',
                        'orientation' => 'L',
                        'font-family' => 'Times New Roman',
                    ]);
                    $footer = array(
                        'odd' => array(
                            // 'L' => array(
                            //     'content' => '',
                            //     'font-size' => 10,
                            //     'font-style' => 'B',
                            //     'font-family' => 'serif',
                            //     'color' => '#000000'
                            // ),
                            // 'C' => array(
                            //     'content' => '',
                            //     'font-size' => 10,
                            //     'font-style' => 'B',
                            //     'font-family' => 'serif',
                            //     'color' => '#000000'
                            // ),
                            'R' => array(
                                'content' => 'Reporting Melawi -- Page {PAGENO} of {nbpg}',
                                'font-size' => 10,
                                // 'font-style' => 'B',
                                'font-family' => 'Times New Roman',
                                'color' => '#000000'
                            ),
                            'line' => 0,
                        ),
                        'even' => array()
                    );
                    $mpdf->setFooter($footer);
                    $mpdf->SetTitle('Laporan Realisasi Sub Kegiatan');
                    $mpdf->WriteHTML(view('laporan.cetakan.subkegiatanpdf.jumlahindex', $hasil), \Mpdf\HTMLParserMode::DEFAULT_MODE, true);
                    $mpdf->AddPage();
                    $mpdf->WriteHTML(view('laporan.cetakan.subkegiatanpdf.sisaindex', $hasil), \Mpdf\HTMLParserMode::DEFAULT_MODE);
                    // $mpdf->OutputHttpDownload('realisasi_subkegiatan.pdf');
                    $mpdf->Output();
                }
                // return $pdf->stream('SubKegiatan.pdf');
                // if ($data['jmldata'] == 0 || $data['jmldata'] == '' || $data['jmldata'] == null) {
                //     $pdf = SnappyPdf::loadView('laporan.cetakan.subkegiatan', $hasil)
                //         ->setPaper('legal', 'landscape')
                //         ->setOption('margin-top', 10)
                //         ->setOption('margin-bottom', 18)
                //         ->setOption('margin-left', 8)
                //         ->setOption('footer-right', "Reporting Melawi -- Page [page] of [toPage]");
                //     return $pdf->stream('SubKegiatan.pdf');
                // } else {
                //     $data = view('laporan.cetakan.subkegiatanpdf.jumlahindex', $hasil);
                //     $pdf = SnappyPdf::loadHTML($data);
                //     $data2 = view('laporan.cetakan.subkegiatanpdf.sisaindex', $hasil);
                //     // $htmlPage2 = SnappyPdf::loadView('laporan.cetakan.subkegiatanpdf.sisaindex', $hasil);
                //     // $pdf = SnappyPdf::loadView('laporan.cetakan.subkegiatanpdf.sisaindex', $hasil);
                //     // $pdf->addPage($data2);
                //     // $pdf->loadView('laporan.cetakan.subkegiatanpdf.sisaindex', $hasil);
                //     $pdf->setPaper('legal', 'landscape');
                //     $pdf->setOption('margin-top', 10);
                //     $pdf->setOption('margin-bottom', 18);
                //     $pdf->setOption('margin-left', 8);
                //     $pdf->setOption('footer-right', "Reporting Melawi -- Page [page] of [toPage]");
                //     return $pdf->stream('SubKegiatan.pdf');
                // }
                break;
            case "excel":
                header("Cache-Control: no-cache, no-store, must_revalidate");
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachement; filename="' . $judul . '.xls"');
                return view('laporan.cetakan.subkegiatan')->with($hasil);
                break;
        }
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }

    // cetak data urusan
    function cetakdataurusan(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $data = $request->all();
            $rincian = json_decode($data['rincian_data'], true);
            $rinciansub = "'" . implode("','", $rincian) . "'";
            $hasil = [
                'judul' => DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')
                    ->select("judul")
                    ->where(['no_transaksi' => $data['no_transaksi']])->first(),
                'hasilsub' => DB::connection($status_sistem->con_sistem_kedua)->select("SELECT a.kd_skpd,(SELECT nm_skpd FROM ms_skpd WHERE kd_skpd=a.kd_skpd) as nm_skpd, a.kd_urusan, a.nm_urusan, a.kd_bidang_urusan, a.nm_bidang_urusan,a.kd_program, a.nm_program,a.kd_kegiatan, a.nm_kegiatan, a.kd_sub_kegiatan, a.nm_sub_kegiatan,ISNULL(a.nilai,0) as anggaran, ISNULL(b.realisasi,0) as realisasi FROM(
                SELECT a.kd_skpd, LEFT(a.kd_rek6,1) as kd_rek6, b.kd_urusan, b.nm_urusan, c.kd_bidang_urusan, c.nm_bidang_urusan,d.kd_program, d.nm_program,e.kd_kegiatan, e.nm_kegiatan, a.kd_sub_kegiatan, a.nm_sub_kegiatan, SUM(a.nilai) as nilai FROM trdrka a LEFT JOIN ms_urusan b ON b.kd_urusan=LEFT(a.kd_sub_kegiatan,1) LEFT JOIN ms_bidang_urusan c ON c.kd_bidang_urusan=LEFT(a.kd_sub_kegiatan,4) LEFT JOIN ms_program d ON d.kd_program=LEFT(a.kd_sub_kegiatan,7) LEFT JOIN ms_kegiatan e ON e.kd_kegiatan=LEFT(a.kd_sub_kegiatan,12) WHERE a.jns_ang = ? AND LEFT(a.kd_sub_kegiatan,1) IN ($rinciansub) GROUP BY a.kd_sub_kegiatan,a.nm_sub_kegiatan,a.kd_skpd,LEFT(a.kd_rek6,1), b.kd_urusan, b.nm_urusan,c.kd_bidang_urusan, c.nm_bidang_urusan, d.kd_program, d.nm_program, e.kd_kegiatan, e.nm_kegiatan) a LEFT JOIN(SELECT a.kd_unit,a.kd_sub_kegiatan, LEFT(a.kd_rek6,1) as kd_rek6, CASE WHEN LEFT(a.kd_rek6,1)='5' THEN ISNULL(SUM(a.debet-a.kredit),0) WHEN LEFT(a.kd_rek6,1)='4' THEN ISNULL(SUM(a.kredit-a.debet),0) ELSE 0 END as realisasi FROM trdju_pkd a INNER JOIN trhju_pkd b ON b.no_voucher=a.no_voucher AND b.kd_skpd=a.kd_unit WHERE b.tgl_voucher BETWEEN ? AND ? GROUP BY a.kd_sub_kegiatan,a.kd_unit,LEFT(a.kd_rek6,1)) b ON b.kd_sub_kegiatan=a.kd_sub_kegiatan AND b.kd_unit=a.kd_skpd AND a.kd_rek6=b.kd_rek6 ORDER BY a.kd_skpd", [$data['jns_ang'], $data['periode1'], $data['periode2']]),
                'periode1' => $data['periode1'],
                'periode2' => $data['periode2'],
                'tandatangan' => DB::connection($status_sistem->con_sistem_pertama)->table('master_ttd')
                    ->where(['id_ttd' => $data['ttd']])->first(),
                'tglttd' => $data['tglttd'],
            ];
            $view = view('laporan.cetakan.suburusan')->with($hasil);

            $judul = 'Sub_Urusan';
            switch ($data['jns_cetak']) {
                case "layar":
                    return $view;
                    break;
                case "pdf":
                    $pdf = SnappyPdf::loadHTML($view)
                        ->setPaper('legal', 'landscape')
                        ->setOption('margin-bottom', 0)
                        ->setOption('margin-top', 10)
                        ->setOption('margin-left', 8)
                        ->setOption('margin-bottom', 5);
                    return $pdf->stream('SubUrusan.pdf');
                    break;
                case "excel":
                    header("Cache-Control: no-cache, no-store, must_revalidate");
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachement; filename="' . $judul . '.xls"');
                    return $view;
                    break;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    function cetakdataprogram(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $data = $request->all();
            $rincian = json_decode($data['rincian_data'], true);
            $rinciansub = "'" . implode("','", $rincian) . "'";
            $hasil = [
                'judul' => DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')
                    ->select("judul")
                    ->where(['no_transaksi' => $data['no_transaksi']])->first(),
                'hasilsub' => DB::connection($status_sistem->con_sistem_kedua)->select("SELECT a.kd_skpd,(SELECT nm_skpd FROM ms_skpd WHERE kd_skpd=a.kd_skpd) as nm_skpd,a.kd_program, a.nm_program,a.kd_kegiatan, a.nm_kegiatan, a.kd_sub_kegiatan, a.nm_sub_kegiatan,ISNULL(a.nilai,0) as anggaran, ISNULL(b.realisasi,0) as realisasi FROM(
                SELECT a.kd_skpd, LEFT(a.kd_rek6,1) as kd_rek6, b.kd_urusan, b.nm_urusan, c.kd_bidang_urusan, c.nm_bidang_urusan,d.kd_program, d.nm_program,e.kd_kegiatan, e.nm_kegiatan, a.kd_sub_kegiatan, a.nm_sub_kegiatan, SUM(a.nilai) as nilai FROM trdrka a LEFT JOIN ms_urusan b ON b.kd_urusan=LEFT(a.kd_sub_kegiatan,1) LEFT JOIN ms_bidang_urusan c ON c.kd_bidang_urusan=LEFT(a.kd_sub_kegiatan,4) LEFT JOIN ms_program d ON d.kd_program=LEFT(a.kd_sub_kegiatan,7) LEFT JOIN ms_kegiatan e ON e.kd_kegiatan=LEFT(a.kd_sub_kegiatan,12) WHERE a.jns_ang = ? AND LEFT(a.kd_sub_kegiatan,7) IN ($rinciansub) GROUP BY a.kd_sub_kegiatan,a.nm_sub_kegiatan,a.kd_skpd,LEFT(a.kd_rek6,1), b.kd_urusan, b.nm_urusan,c.kd_bidang_urusan, c.nm_bidang_urusan, d.kd_program, d.nm_program, e.kd_kegiatan, e.nm_kegiatan) a LEFT JOIN(SELECT a.kd_unit,a.kd_sub_kegiatan, LEFT(a.kd_rek6,1) as kd_rek6, CASE WHEN LEFT(a.kd_rek6,1)='5' THEN ISNULL(SUM(a.debet-a.kredit),0) WHEN LEFT(a.kd_rek6,1)='4' THEN ISNULL(SUM(a.kredit-a.debet),0) ELSE 0 END as realisasi FROM trdju_pkd a INNER JOIN trhju_pkd b ON b.no_voucher=a.no_voucher AND b.kd_skpd=a.kd_unit WHERE b.tgl_voucher BETWEEN ? AND ? GROUP BY a.kd_sub_kegiatan,a.kd_unit,LEFT(a.kd_rek6,1)) b ON b.kd_sub_kegiatan=a.kd_sub_kegiatan AND b.kd_unit=a.kd_skpd AND a.kd_rek6=b.kd_rek6 ORDER BY a.kd_skpd", [$data['jns_ang'], $data['periode1'], $data['periode2']]),
                'periode1' => $data['periode1'],
                'periode2' => $data['periode2'],
                'tandatangan' => DB::connection($status_sistem->con_sistem_pertama)->table('master_ttd')
                    ->where(['id_ttd' => $data['ttd']])->first(),
                'tglttd' => $data['tglttd'],
            ];
            // dd($hasil['hasilsub']);
            $view = view('laporan.cetakan.subprogram')->with($hasil);

            $judul = 'Sub_Program';
            switch ($data['jns_cetak']) {
                case "layar":
                    return $view;
                    break;
                case "pdf":
                    $pdf = SnappyPdf::loadHTML($view)
                        ->setPaper('legal', 'landscape')
                        ->setOption('margin-bottom', 0)
                        ->setOption('margin-top', 10)
                        ->setOption('margin-left', 8)
                        ->setOption('margin-bottom', 5);
                    return $pdf->stream('SubProgram.pdf');
                    break;
                case "excel":
                    header("Cache-Control: no-cache, no-store, must_revalidate");
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachement; filename="' . $judul . '.xls"');
                    return $view;
                    break;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    function cetakdatakegiatan(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $data = $request->all();
            $rincian = json_decode($data['rincian_data'], true);
            $rinciansub = "'" . implode("','", $rincian) . "'";
            $hasil = [
                'judul' => DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')
                    ->select("judul")
                    ->where(['no_transaksi' => $data['no_transaksi']])->first(),
                'hasilsub' => DB::connection($status_sistem->con_sistem_kedua)->select("SELECT a.kd_skpd,(SELECT nm_skpd FROM ms_skpd WHERE kd_skpd=a.kd_skpd) as nm_skpd,a.kd_kegiatan, a.nm_kegiatan, a.kd_sub_kegiatan, a.nm_sub_kegiatan,ISNULL(a.nilai,0) as anggaran, ISNULL(b.realisasi,0) as realisasi FROM(
                SELECT a.kd_skpd, LEFT(a.kd_rek6,1) as kd_rek6, b.kd_urusan, b.nm_urusan, c.kd_bidang_urusan, c.nm_bidang_urusan,d.kd_program, d.nm_program,e.kd_kegiatan, e.nm_kegiatan, a.kd_sub_kegiatan, a.nm_sub_kegiatan, SUM(a.nilai) as nilai FROM trdrka a LEFT JOIN ms_urusan b ON b.kd_urusan=LEFT(a.kd_sub_kegiatan,1) LEFT JOIN ms_bidang_urusan c ON c.kd_bidang_urusan=LEFT(a.kd_sub_kegiatan,4) LEFT JOIN ms_program d ON d.kd_program=LEFT(a.kd_sub_kegiatan,7) LEFT JOIN ms_kegiatan e ON e.kd_kegiatan=LEFT(a.kd_sub_kegiatan,12) WHERE a.jns_ang = ? AND LEFT(a.kd_sub_kegiatan,12) IN ($rinciansub) GROUP BY a.kd_sub_kegiatan,a.nm_sub_kegiatan,a.kd_skpd,LEFT(a.kd_rek6,1), b.kd_urusan, b.nm_urusan,c.kd_bidang_urusan, c.nm_bidang_urusan, d.kd_program, d.nm_program, e.kd_kegiatan, e.nm_kegiatan) a LEFT JOIN(SELECT a.kd_unit,a.kd_sub_kegiatan, LEFT(a.kd_rek6,1) as kd_rek6, CASE WHEN LEFT(a.kd_rek6,1)='5' THEN ISNULL(SUM(a.debet-a.kredit),0) WHEN LEFT(a.kd_rek6,1)='4' THEN ISNULL(SUM(a.kredit-a.debet),0) ELSE 0 END as realisasi FROM trdju_pkd a INNER JOIN trhju_pkd b ON b.no_voucher=a.no_voucher AND b.kd_skpd=a.kd_unit WHERE b.tgl_voucher BETWEEN ? AND ? GROUP BY a.kd_sub_kegiatan,a.kd_unit,LEFT(a.kd_rek6,1)) b ON b.kd_sub_kegiatan=a.kd_sub_kegiatan AND b.kd_unit=a.kd_skpd AND a.kd_rek6=b.kd_rek6 ORDER BY a.kd_skpd", [$data['jns_ang'], $data['periode1'], $data['periode2']]),
                'periode1' => $data['periode1'],
                'periode2' => $data['periode2'],
                'tandatangan' => DB::connection($status_sistem->con_sistem_pertama)->table('master_ttd')
                    ->where(['id_ttd' => $data['ttd']])->first(),
                'tglttd' => $data['tglttd'],
            ];
            // dd($hasil['hasilsub']);
            $view = view('laporan.cetakan.kegiatan')->with($hasil);

            $judul = 'Kegiatan';
            switch ($data['jns_cetak']) {
                case "layar":
                    return $view;
                    break;
                case "pdf":
                    $pdf = SnappyPdf::loadHTML($view)
                        ->setPaper('legal', 'landscape')
                        ->setOption('margin-bottom', 0)
                        ->setOption('margin-top', 10)
                        ->setOption('margin-left', 8)
                        ->setOption('margin-bottom', 5);
                    return $pdf->stream('Kegiatan.pdf');
                    break;
                case "excel":
                    header("Cache-Control: no-cache, no-store, must_revalidate");
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachement; filename="' . $judul . '.xls"');
                    return $view;
                    break;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    function updatedata(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $data = $request->data;
            $username = Auth::user()->username;
            $id_user = Auth::user()->id_user;
            DB::beginTransaction();
            $nomorurut = $data['no_transaksi'];
            DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')
                ->where(['no_transaksi' => $data['no_transaksi'], 'id_user' => $id_user])
                ->update([
                    'jenis' => $data['jenis'],
                    'judul' => $data['judul'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'username' => $username
                ]);
            // return;
            DB::connection($status_sistem->con_sistem_pertama)->table('rincian_header_laporan')->where(['no_transaksi' => $data['no_transaksi'], 'id_user' => $id_user])->delete();
            // return;
            if (isset($data['datatampungan'])) {
                DB::connection($status_sistem->con_sistem_pertama)->table('rincian_header_laporan')->insert(array_map(
                    function ($element) use ($nomorurut, $data, $id_user) {
                        return [
                            'no_transaksi' => $nomorurut,
                            'kode_data' => $element['kd_data'],
                            'nama_data' => $element['nm_data'],
                            'jenis' => $data['jenis'],
                            'id_user' => $id_user
                        ];
                    },
                    $data['datatampungan']
                ));
            }
            DB::commit();
            return response()->json(['pesan' => 'Berhasil Update']);
        } catch (\Throwable $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function hapusdata(Request $request)
    {
        try {
            $status_sistem = dashboard_tahun()->getData();
            $data = $request->all();
            $id_user = Auth::user()->id_user;
            DB::beginTransaction();
            $hasil =  DB::connection($status_sistem->con_sistem_pertama)->table('header_laporan')->where(['no_transaksi' => $data['no_transaksi'], 'jenis' => $data['jenis'], 'id_user' => $id_user])->delete();
            if ($hasil) {
                DB::connection($status_sistem->con_sistem_pertama)->table('rincian_header_laporan')->where(['no_transaksi' => $data['no_transaksi'], 'jenis' => $data['jenis'], 'id_user' => $id_user])->delete();
            }
            DB::commit();
            return response()->json(['pesan' => 'Berhasil dihapus']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => 'Gagal dihapus']);
        }
    }
}
