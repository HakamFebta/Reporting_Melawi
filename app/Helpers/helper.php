<?php
// namespace App\Helpers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;






if (!function_exists('menu')) {
    function menu()
    {
        $id_user = Auth::user()->id_user;
        $menus = DB::table('Users as a')
            ->join('Roles as b', 'b.roles', '=', 'a.roles')
            ->join('Roles_users as c', function ($join) {
                $join->on('c.id_roles', '=', 'a.roles');
                $join->on('a.id_user', '=', 'c.id_user');
            })
            // ->join('Roles_users as c', 'c.id_roles', '=', 'a.roles', 'a.id_user', '=', 'c.id_user')
            ->join('Roles_menus as d', 'd.id_menu', '=', 'c.id_menus')
            ->join('Roles_acces as e', 'e.id_user', '=', 'a.id_user')
            ->select('d.id_menu', 'd.name', 'd.display_name', 'd.parent', 'd.sub_menu')
            ->where(['a.id_user' => $id_user, 'd.sub_menu' => null, 'd.status' => '1'])
            ->orderBy('d.hak_akses1')
            ->get();

        return $menus;
    }
}

function sub_menu()
{
    $id_user = Auth::user()->id_user;
    $sub_menu = DB::table('Users as a')
        ->join('Roles as b', 'b.roles', '=', 'a.roles')
        ->join('Roles_users as c', function ($join) {
            $join->on('c.id_roles', '=', 'a.roles');
            $join->on('a.id_user', '=', 'c.id_user');
        })
        ->join('Roles_menus as d', 'd.id_menu', '=', 'c.id_menus')
        ->join('Roles_acces as e', 'e.id_user', '=', 'a.id_user')
        ->select('d.id_menu', 'd.name', 'd.display_name', 'd.parent', 'd.sub_menu')
        ->where(['a.id_user' => $id_user, 'd.sub_menu' => '1', 'd.status' => '1'])
        ->orderBy('d.hak_akses2')
        ->orderBy('d.hak_akses1')
        ->get();

    return $sub_menu;
}

function sub_submenu()
{
    $id_user = Auth::user()->id_user;
    $sub_submenu = DB::table('Users as a')
        ->join('Roles as b', 'b.roles', '=', 'a.roles')
        ->join('Roles_users as c', function ($join) {
            $join->on('c.id_roles', '=', 'a.roles');
            $join->on('a.id_user', '=', 'c.id_user');
        })
        ->join('Roles_menus as d', 'd.id_menu', '=', 'c.id_menus')
        ->join('Roles_acces as e', 'e.id_user', '=', 'a.id_user')
        ->select('d.id_menu', 'd.name', 'd.display_name', 'd.parent', 'd.sub_menu')
        ->where(['a.id_user' => $id_user, 'd.sub_menu' => '2', 'd.status' => '1'])
        ->orderBy('d.hak_akses2')
        ->orderBy('d.hak_akses1')
        ->get();

    return $sub_submenu;
}

function status_anggaran()
{
    $id_user = Auth::user()->id_user;
    DB::beginTransaction();
    DB::commit();
    $status_sistem = dashboard_tahun()->getData();
    $status_anggaran = DB::connection($status_sistem->con_sistem_kedua)->select("SELECT DISTINCT a.jns_ang FROM trhrka a WHERE a.tgl_dpa IN(SELECT MAX(tgl_dpa) FROM trhrka WHERE status = '1')");
    foreach ($status_anggaran as $jns_ang) {
        $stts_anggaran = $jns_ang->jns_ang;
    }
    if ($stts_anggaran == 'S') {
        $data = ['nama_anggaran' => 'Murni'];
    } else if ($stts_anggaran == 'M') {
        $data = ['nama_anggaran' => 'Penetapan'];
    } else if ($stts_anggaran == 'P1') {
        $data = ['nama_anggaran' => 'Pergeseran I'];
    } else if ($stts_anggaran == 'P2') {
        $data = ['nama_anggaran' => 'Pergeseran II'];
    } else if ($stts_anggaran == 'P3') {
        $data = ['nama_anggaran' => 'Pergeseran III'];
    } else if ($stts_anggaran == 'P4') {
        $data = ['nama_anggaran' => 'Pergeseran IV'];
    } else if ($stts_anggaran == 'P5') {
        $data = ['nama_anggaran' => 'Pergeseran V'];
    } else if ($stts_anggaran == 'U1') {
        $data = ['nama_anggaran' => 'Perubahan I'];
    } else if ($stts_anggaran == 'U2') {
        $data = ['nama_anggaran' => 'Perubahan II'];
    } else if ($stts_anggaran == 'U3') {
        $data = ['nama_anggaran' => 'Perubahan III'];
    } else if ($stts_anggaran == 'U4') {
        $data = ['nama_anggaran' => 'Perubahan IV'];
    } else if ($stts_anggaran == 'U5') {
        $data = ['nama_anggaran' => 'Perubahan V'];
    }
    $data = response()->json([
        'nama_anggaran' => $data,
        'jns_anggaran' => $stts_anggaran,
    ]);
    return $data;
}

function bulan($bulan)
{
    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
    }
    return $bulan;
}

function tgl_format_indonesia($tgl)
{
    $tanggal  = explode('-', $tgl);
    $bulan  = bulan($tanggal[1]);
    $tahun  =  $tanggal[0];
    // dd($tanggal);
    return  $tanggal[2] . ' ' . $bulan . ' ' . $tahun;
}

function dashboard_tahun()
{
    $id_user = Auth::user()->id_user;
    DB::beginTransaction();
    $hasil = DB::connection('sqlsrv')->table('Users_tahun')->select('tahun')->where('id_users', '=', $id_user)->first();
    DB::commit();
    if ($hasil->tahun == '2023') {
        $con_sistem_pertama = 'sqlsrv';
        $con_sistem_kedua = 'sqlsrvsimakda';
    } elseif ($hasil->tahun == '2024') {
        $con_sistem_pertama = 'sistem_2024';
        $con_sistem_kedua = 'sistemkedua_2024';
    } elseif ($hasil->tahun == '2025') {
        $con_sistem_pertama = 'sistem_2025';
        $con_sistem_kedua = 'sistemkedua_2025';
    }
    return response()->json([
        'tahun' => $hasil->tahun,
        'con_sistem_pertama' => $con_sistem_pertama,
        'con_sistem_kedua' => $con_sistem_kedua
    ]);
}
