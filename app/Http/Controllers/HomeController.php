<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\PDO\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Js;
use Response;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;


class HomeController extends Controller
{
    public function index()
    {
        $status_anggarann = status_anggaran();
        $status_anggarann = $status_anggarann->getData();
        // dd($status_anggarann);
        // return;
        $status_anggaran = $status_anggarann->jns_anggaran;
        $nama_anggaran = $status_anggarann->nama_anggaran;
        $data = [
            'data_pendapatan' => DB::connection('sqlsrvsimakda')->table('trdrka')
                ->select(DB::raw("isnull(sum(nilai),0) as pendapatan"))
                ->where(['jns_ang' => $status_anggaran])
                ->where(DB::raw('left(kd_rek6,1)'), 4)
                ->first(),
            'data_belanja' => DB::connection('sqlsrvsimakda')->table('trdrka')
                ->select(DB::raw("isnull(sum(nilai),0) as belanja"))
                ->where(['jns_ang' => $status_anggaran])
                ->where(DB::raw('left(kd_rek6,1)'), 5)
                ->first(),
            'data_pem_terima' => DB::connection('sqlsrvsimakda')->table('trdrka')
                ->select(DB::raw("isnull(sum(nilai),0)as pem_terima"))
                ->where(['jns_ang' => $status_anggaran])
                ->where(DB::raw('left(kd_rek6,2)'), 61)
                ->first(),
            'data_pem_keluar' => DB::connection('sqlsrvsimakda')->table('trdrka')
                ->select(DB::raw("isnull(sum(nilai),0) as pem_keluar"))
                ->where(['jns_ang' => $status_anggaran])
                ->where(DB::raw('left(kd_rek6,2)'), 62)
                ->first(),
            'nama_anggaran' => $nama_anggaran
        ];
        return view('layout.dashboard')->with($data);
    }

    public function username()
    {
        try {
            $data = [
                'roles' => DB::connection('sqlsrv')->table('Roles')
                    ->select('roles', 'name_roles')
                    ->get()
            ];
            return view('utility.username')->with($data);
        } catch (\Throwable $th) {
            echo 'Message: ' . $th->getMessage();
        }
    }

    public function listdatausername()
    {
        try {
            $data = DB::connection('sqlsrv')->table('Users')
                ->select('id_user', 'username', 'status', 'jenis', 'roles', 'nama', DB::raw("CASE
                    WHEN jenis =1 THEN 'Super Admin'
                    WHEN jenis = 2 THEN 'Admin'
                    ELSE 'Client' END AS nm_jenis"))
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->status == '1') {
                        $btn = '<form autocomplete="on">
                            <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" style="margin-left:5px;" type="checkbox"  onChange="ubahStatus(\'' . $row->id_user . '\',\'' . $row->username . '\',\'' . $row->status . '\')" />
                            </form>';
                    } else if ($row->status == '0') {
                        $btn = '<form autocomplete="on">
                            <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" style="margin-left:5px;" type="checkbox"  onChange="ubahStatus(\'' . $row->id_user . '\',\'' . $row->username . '\',\'' . $row->status . '\')" checked />
                            </form>';
                    };
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    public function whereupdateusername(Request $request)
    {
        try {
            $data = $request->data;
            DB::beginTransaction();
            DB::connection('sqlsrv')->table('Users')
                ->where('id_user', '=', $data['id_user'])
                ->update(['jenis' => $data['jenis'], 'roles' => $data['pengguna']]);
            DB::table('Roles_users')->where(['id_user' => $data['id_user']])->delete();
            if (isset($data['tampungan'])) {
                DB::connection('sqlsrv')->table('Roles_users')->insert(array_map(function ($element) use ($data) {
                    return [
                        'id_roles' => $data['pengguna'],
                        'id_menus' => $element['val'],
                        'id_user' => $data['id_user'],
                    ];
                }, $data['tampungan']));
            }
            DB::commit();
            return response()->json(['pesan' => 'Berhasil diupdate']);
        } catch (\Throwable $th) {
            return response()->json(['pesan' => $th->getMessage()]);
        }
    }

    public function listmenuusername(Request $request)
    {
        try {
            $data = $request->id_user;
            $hasil = DB::connection('sqlsrv')->table('Roles_users')->where(['id_user' => $data])->orderBy('id_menus', 'asc')->get();
            return response()->json(['hasil' => $hasil]);
        } catch (\Throwable $th) {
            return response()->json(['pesan' => $th->getMessage()]);
        }
    }

    public function updatestatususername(Request $request)
    {
        try {
            $data = $request->all();
            // dd($data['username']);
            if ($data['status'] == '1') {
                DB::connection('sqlsrv')->table('Users')
                    ->where([
                        ['id_user', '=', $data['id_user']],
                        ['username', '=', $data['username']],
                    ])
                    ->update(['status' => '0']);
                DB::commit();
                return response()->json(['pesan' => 'berhasil di aktifkan']);
            } else if ($data['status'] == '0') {
                DB::connection('sqlsrv')->table('Users')
                    ->where([
                        ['id_user', '=', $data['id_user']],
                        ['username', '=', $data['username']],
                    ])
                    ->update(['status' => '1']);
                DB::commit();
                return response()->json(['pesan' => 'berhasil di non aktifkan']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => $th->getMessage()]);
        }
    }

    public function hapususername(Request $request)
    {
        try {
            $data = $request->all();
            DB::beginTransaction();
            $hasil1 = DB::connection('sqlsrv')->table('header_laporan')
                ->where(['id_user' => $data['id_user']])
                ->distinct()->count('id_user');
            $hasil2 = DB::connection('sqlsrv')->table('rincian_header_laporan')
                ->where(['id_user' => $data['id_user']])
                ->distinct()->count('id_user');
            if (($hasil1 > 0) && ($hasil2 > 0)) {
                return response()->json(['pesan' => 'Username tidak bisa dihapus, sudah ada inputan transaksi']);
            } else {
                DB::connection('sqlsrv')->table('Users')->where('id_user', '=', $data['id_user'])->delete();
                DB::connection('sqlsrv')->table('Roles_acces')->where('id_user', '=', $data['id_user'])->delete();
                DB::commit();
                return response()->json(['pesan' => 'Berhasil dihapus']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => $th->getMessage()]);
        }
    }

    public function updatestatususernameall(Request $request)
    {
        try {
            $data = $request->all();
            if ($data['status'] == '1') {
                DB::connection('sqlsrv')->table('Users')
                    ->update(['status' => '0']);
                DB::commit();
                return response()->json(['pesan' => 'berhasil semua diaktifkan']);
            } else if ($data['status'] == '0') {
                DB::connection('sqlsrv')->table('Users')
                    ->update(['status' => '1']);
                DB::commit();
                return response()->json(['pesan' => 'berhasil semua dinonaktifkan']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => $th->getMessage()]);
        }
    }

    public function simpandatausername(Request $request)
    {
        try {
            $data = $request->data;
            if (!empty($data['nama'] && $data['username'] && $data['password'])) {
                if ($data['username']) {
                    DB::beginTransaction();
                    $hasil = DB::connection('sqlsrv')->table('Users')
                        ->select(DB::raw('COUNT(username) as username'))
                        ->where('username', '=', $data['username'])
                        ->first();
                    DB::commit();
                    if ($hasil->username >= 1) {
                        return response()->json(['pesan' => '1']);
                    } else {
                        DB::beginTransaction();
                        DB::connection('sqlsrv')->table('Users')->raw('LOCK TABLES Users WRITE');
                        DB::connection('sqlsrv')->table('Users')->insert([
                            'nama' => $data['nama'],
                            'username' => $data['username'],
                            'password' => Hash::make($data['password']),
                            'status' => '0',
                            'tambah' => '1',
                            'hapus' => '1',
                            'edit' => '1',
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                        DB::commit();
                        return response()->json(['pesan' => '0']);
                    }
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => $th->getMessage()]);
        }
    }

    public function gantinama()
    {
        return view('utility.gantinamapassword');
    }

    public function listdatausernameall()
    {
        try {
            $jenis = Auth::user()->jenis;
            $id_user = Auth::user()->id_user;

            if ($jenis == '1') {
                $data = DB::connection('sqlsrv')->table('Users')
                    ->select('id_user', 'nama', 'username', 'status', 'jenis', DB::raw("CASE
                    WHEN jenis =1 THEN 'Super Admin'
                    WHEN jenis = 2 THEN 'Admin'
                    ELSE 'Client' END AS jenis"))
                    ->get();
            } else if ($jenis == '2') {
                $data = DB::connection('sqlsrv')->table('Users')
                    ->select('id_user', 'nama', 'username', 'status', 'jenis', DB::raw("CASE
                    WHEN jenis =1 THEN 'Super Admin'
                    WHEN jenis = 2 THEN 'Admin'
                    ELSE 'Client' END AS jenis"))
                    ->where(['id_user' => $id_user])
                    ->get();
            } else if ($jenis == '3') {
                $data = DB::connection('sqlsrv')->table('Users')
                    ->select('id_user', 'nama', 'username', 'status', 'jenis', DB::raw("CASE
                    WHEN jenis =1 THEN 'Super Admin'
                    WHEN jenis = 2 THEN 'Admin'
                    ELSE 'Client' END AS jenis"))
                    ->where(['id_user' => $id_user])
                    ->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '<button type="button" style="margin:0px 5px 0px 25px;" data-toggle="modal" class="btn btn-warning btn-sm buttonedit-username" title="Edit Username"/><i class="bx bx-pencil"></i></button>';
                    $btn .= '<button type="button" data-toggle="modal" class="btn btn-info btn-sm buttonedit-password" title="Edit Password"/><i class="bx bx-edit"></i></button>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    public function updateusername(Request $request)
    {
        try {
            $data = $request->all();
            DB::beginTransaction();
            $hasil = DB::table('Users')->where('username', '=', $data['usernamenew'])->count();
            if ($hasil == 1) {
                return response()->json(['pesan' => '1']);
            } else {
                if ($data['nama'] != '' && $data['usernamenew'] != '') {
                    DB::connection('sqlsrv')->table('Users')
                        ->where(['id_user' => $data['id_user'], 'username' => $data['username']])
                        ->update([
                            'username' => $data['usernamenew'], 'nama' => $data['nama']
                        ]);
                }
                if ($data['usernamenew'] != '') {
                    DB::connection('sqlsrv')->table('Users')
                        ->where(['id_user' => $data['id_user'], 'username' => $data['username']])
                        ->update([
                            'username' => $data['usernamenew']
                        ]);
                }
                if ($data['nama'] != '') {
                    DB::connection('sqlsrv')->table('Users')
                        ->where(['id_user' => $data['id_user'], 'username' => $data['username']])
                        ->update([
                            'nama' => $data['nama']
                        ]);
                }
            }
            DB::commit();
            return response()->json(['pesan' => '0']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => $th->getMessage()]);
        }
    }
    public function updatepassword(Request $request)
    {
        try {
            $id_user = Auth::user()->id_user;
            $data = $request->all();
            if ($id_user == $data['id_user']) {
                $perbandingan = 'sama';
            } else {
                $perbandingan = 'tidak sama';
            }

            DB::beginTransaction();
            DB::connection('sqlsrv')->table('Users')
                ->where(['id_user' => $data['id_user'], 'username' => $data['username']])
                ->update(['password' => Hash::make($data['passwordnew'])]);
            DB::commit();

            return response()->json([
                'pesan' => 'Berhasil diupdate',
                'perbandingan' => $perbandingan
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'pesan' => $th->getMessage()
            ]);
        }
    }


    function profile()
    {
        try {
            $id_user =  Auth::user()->id_user;
            $username =  Auth::user()->username;
            $data = ['id_user' => Auth::user()->id_user, 'username' => Auth::user()->username, 'nama' => Auth::user()->nama];
            return view('utility.profile')->with($data);
        } catch (\Throwable $th) {
            return response()->json([
                'pesan' => $th->getMessage()
            ]);
        }
    }

    function updateprofile(Request $request)
    {
        try {
            $id_user = Auth::user()->id_user;
            $data = $request->all();
            if ($data['usernamenew']) {
                DB::beginTransaction();
                $hasil = DB::connection('sqlsrv')->table('Users')->where('username', '=', $data['usernamenew'])->count();
                DB::commit();
                if ($hasil > 0) {
                    return response()->json([
                        'pesan' => 8,
                        'text' => 'Username sudah dipakai'
                    ]);
                }
            }

            if ($data['namanew'] != '' && $data['passwordnew'] == '' && $data['usernamenew'] == '') {
                DB::beginTransaction();
                DB::connection('sqlsrv')->table('Users')->where('id_user', $id_user)
                    ->update(['nama' => $data['namanew']]);
                DB::commit();
                return response()->json([
                    'pesan' => 1,
                    'text' => 'Berhasil diupdate nama'
                ]);
            }
            if ($data['usernamenew'] != '' && $data['namanew'] == '' && $data['passwordnew'] == '') {
                DB::beginTransaction();
                DB::connection('sqlsrv')->table('Users')->where('id_user', $id_user)
                    ->update(['username' => $data['usernamenew']]);
                DB::commit();
                return response()->json([
                    'pesan' => 2,
                    'text' => 'Berhasil diupdate username'
                ]);
            }
            if ($data['passwordnew'] != '' && $data['usernamenew'] == '' && $data['namanew'] == '') {
                DB::beginTransaction();
                DB::connection('sqlsrv')->table('Users')->where('id_user', $id_user)
                    ->update(['password' => Hash::make($data['passwordnew'])]);
                DB::commit();
                return response()->json([
                    'pesan' => 3,
                    'text' => 'Berhasil diupdate password'
                ]);
            }
            if ($data['namanew'] != '' && $data['usernamenew'] != '' && $data['passwordnew'] != '') {
                DB::beginTransaction();
                DB::connection('sqlsrv')->table('Users')->where('id_user', $id_user)
                    ->update(['nama' => $data['namanew'], 'username' => $data['usernamenew'], 'password' => Hash::make($data['passwordnew'])]);
                DB::commit();
                return response()->json([
                    'pesan' => 4,
                    'text' => 'Data berhasil diupdate'
                ]);
            }
            if ($data['namanew'] != '' && $data['usernamenew'] != '') {
                DB::beginTransaction();
                DB::connection('sqlsrv')->table('Users')->where('id_user', $id_user)
                    ->update(['nama' => $data['namanew'], 'username' => $data['usernamenew']]);
                DB::commit();
                return response()->json([
                    'pesan' => 5,
                    'text' => 'Data berhasil diupdate'
                ]);
            }
            if ($data['namanew'] != '' && $data['passwordnew'] != '') {
                DB::beginTransaction();
                DB::connection('sqlsrv')->table('Users')->where('id_user', $id_user)
                    ->update(['nama' => $data['namanew'], 'password' => Hash::make($data['passwordnew'])]);
                DB::commit();
                return response()->json([
                    'pesan' => 6,
                    'text' => 'Data berhasil diupdate'
                ]);
            }
            if ($data['usernamenew'] != '' && $data['passwordnew'] != '') {
                DB::beginTransaction();
                DB::connection('sqlsrv')->table('Users')->where('id_user', $id_user)
                    ->update(['username' => $data['usernamenew'], 'password' => Hash::make($data['passwordnew'])]);
                DB::commit();
                return response()->json([
                    'pesan' => 7,
                    'text' => 'Data berhasil diupdate'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'pesan' => $th->getMessage()
            ]);
        }
    }

    function refreshprofile()
    {
        try {
            DB::beginTransaction();
            $id_user = Auth::user()->id_user;
            $data = DB::connection('sqlsrv')->table('Users')->where(['id_user' => $id_user])->first();
            return response()->json(['hasil' => $data]);
        } catch (\Throwable $th) {
            return response()->json([
                'pesan' => $th->getMessage()
            ]);
        }
    }
}
