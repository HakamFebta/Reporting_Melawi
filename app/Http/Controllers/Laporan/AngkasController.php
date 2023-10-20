<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AngkasController extends Controller
{
    function index()
    {
        return view('laporan.angkas.index');
    }

    function cetakangkas(Request $request)
    {
        // dd($request->jenis);
        $hasil = ['hasil' => DB::connection('sqlsrvsimakda')
            ->select("SELECT * FROM(
            SELECT '1'as urut,'tetap' as status, nm_skpd as nm_skpd, murni as nilai from status_angkas
            UNION ALL
            SELECT '2'as urut,'geser1' as status, nm_skpd as nm_skpd ,sempurna1 as nilai from status_angkas
            UNION ALL
            SELECT '3'as urut,'geser2' as status, nm_skpd as nm_skpd ,sempurna2 as nilai from status_angkas
            UNION ALL
            SELECT '4'as urut,'geser3' as status, nm_skpd as nm_skpd ,sempurna3 as nilai from status_angkas
            UNION ALL
            SELECT '5'as urut,'geser4' as status, nm_skpd as nm_skpd ,sempurna4 as nilai from status_angkas
            UNION ALL
            SELECT '6'as urut,'geser5' as status, nm_skpd as nm_skpd ,sempurna5 as nilai from status_angkas
            UNION ALL
            SELECT '7'as urut,'ubah1' as status, nm_skpd as nm_skpd ,ubah as nilai from status_angkas
            UNION ALL
            SELECT '8'as urut,'ubah2' as status, nm_skpd as nm_skpd ,ubah1 as nilai from status_angkas) a WHERE a.status= ?", [$request->jns_angkas])];

        $view = view('laporan.angkas.cetak')->with($hasil);
        switch ($request->jenis) {
            case "layar":
                return $view;
                break;
            case "pdf":
                echo ('tidak ada');
                break;
            case "excel":
                echo ('tidak ada');
                break;
        }
    }
}
