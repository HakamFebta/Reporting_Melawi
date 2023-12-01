<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TandaTanganController extends Controller
{
    public function index()
    {
        return view('master.tandatangan');
    }

    public function listdatattd()
    {
        DB::beginTransaction();
        $data = DB::connection('sqlsrv')->table('master_ttd')->get();
        DB::commit();
        return response()->json($data);
    }

    function simpandatatandatangan(Request $request)
    {
        try {
            $data = $request->all();
            DB::beginTransaction();
            $hasil = DB::connection('sqlsrv')->table('master_ttd')
                ->select(DB::raw('COUNT(nama) as nama'))
                ->where(['nama' => $data['nama']])
                ->first();
            if ($hasil->nama > 1) {
                return response()->json(['pesan' => '1']);
            } else {
                DB::connection('sqlsrv')->table('master_ttd')->raw('LOCK TABLES master_ttd WRITE');
                DB::connection('sqlsrv')->table('master_ttd')->insert([
                    'nama' => $data['nama'],
                    'nip' => $data['nip'],
                    'jabatan' => $data['jbtn'],
                    'pangkat' => $data['pangkat']
                ]);
                DB::commit();
                return response()->json(['pesan' => '0']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => $th]);
        }
    }

    function updatedatatandatangan(Request $request)
    {
        try {
            $data = $request->all();
            DB::beginTransaction();
            DB::connection('sqlsrv')->table('master_ttd')->where(['id_ttd' => $data['id_ttd']])
                ->update(['nama' => $data['nama'], 'nip' => $data['nip'], 'jabatan' => $data['jbtn'], 'pangkat' => $data['pangkat']]);
            DB::commit();
            return response()->json(['pesan' => '0']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => $th]);
        }
    }

    function hapusdatatandatangan(Request $request)
    {
        try {
            $data = $request->all();
            DB::connection('sqlsrv')->table('master_ttd')->where('id_ttd',  $data['id_ttd'])->delete();
            return response()->json(['pesan' => 'Data dihapus']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['pesan' => $th]);
        }
    }
}
