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
        $data = [
            'roles' => DB::connection('sqlsrv')->table('Roles')
                ->select('roles', 'name_roles')
                ->get()
        ];
        return view('utility.username')->with($data);
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
                        $btn = '<form autocomplete="off">
                            <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" style="margin-left:5px;" type="checkbox" name="statususername" onChange="ubahStatus(\'' . $row->id_user . '\',\'' . $row->username . '\',\'' . $row->status . '\')" id="statususername1" />
                            </form>';
                    } else if ($row->status == '0') {
                        $btn = '<form autocomplete="off">
                            <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" style="margin-left:5px;" type="checkbox" name="statususername" onChange="ubahStatus(\'' . $row->id_user . '\',\'' . $row->username . '\',\'' . $row->status . '\')" id="statususername1" checked />
                            </form>';
                    };
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    public function whereupdateusername(Request $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        DB::connection('sqlsrv')->table('Users')
            ->where('id_user', '=', $data['id_user'])
            ->update([
                'jenis' => $data['jenis'],
                'roles' => $data['pengguna']
            ]);
        $hasil = DB::connection('sqlsrv')->table('Roles_acces')->where('id_user', '=', $data['id_user'])->delete();
        if ($hasil) {
            DB::connection('sqlsrv')->table('Roles_acces')->insert([
                'roles' => $data['pengguna'],
                'id_user' => $data['id_user']
            ]);
        }
        DB::commit();
        return response()->json(['pesan' => 'Berhasil Update']);
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
            return response()->json(['pesan' => 'Gagal']);
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
            return response()->json(['pesan' => 'Gagal']);
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
                    $btn = '<button type="button" style="margin:0px 5px 0px 20px;" data-toggle="modal" class="btn btn-warning btn-sm buttonedit-username" title="Edit Username"/><i class="bx bx-pencil"></i></button>';
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
            DB::commit();
            return response()->json(['pesan' => 'berhasil update']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => 'gagal update']);
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
                'pesan' =>
                'berhasil update',
                'perbandingan' => $perbandingan
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'pesan' => 'gagal update'
            ]);
        }
    }
}
