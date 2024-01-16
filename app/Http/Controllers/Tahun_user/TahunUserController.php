<?php

namespace App\Http\Controllers\Tahun_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TahunUserController extends Controller
{
    public function index()
    {
        return view('tahun_users.index');
    }

    function pilihantahun(Request $request)
    {
        $data = $request->all();
        $id_user = Auth::user()->id_user;
        DB::beginTransaction();
        $hapus = DB::connection('sqlsrv')->table('Users_tahun')->where(['id_users' => $id_user])->delete();
        if ($hapus) {
            DB::connection('sqlsrv')->table('Users_tahun')->insert(
                ['tahun' => $data['tahun'], 'id_users' => $id_user, 'created_at' => date('Y-m-d H:i:s')]
            );
        }

        DB::commit();
    }
}
