<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\ImageManager;
use App\Models\ImagesBuku;
use Illuminate\Support\Facades\Validator;



class BukuController extends Controller
{
    public function index()
    {
        return view('master.buku.index');
    }

    public function listdata()
    {
        try {
            $data = DB::table('ms_databuku')
                ->orderBy('id', 'asc')
                ->get();
            // var_dump($data);
            // return;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#" class="btn btn-primary btn-sm" style="margin-right:4px;"><i class="bx bx-pencil"></i></a>';
                    $btn .= '<a href="#" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return view('master.buku.index');
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    public function create()
    {
        return view('master.buku.create');
    }


    public function simpan_data(Request $request)
    {
        // dd($request->all());
        // return;

        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'judulbuku' => 'required|min:1',
                    'kategori' => 'required|min:1',
                    'pengarang' => 'required|min:1',
                    'isbn' => 'required|min:1',
                    'jmlhal' => 'required|min:1',
                    'jmlbuku' => 'required|min:1',
                    'thnterbit' => 'required|min:4',
                    'sinopsis' => 'required|min:1',
                    'penerbit' => 'required|min:1',
                    'rak' => 'required|min:1',
                    'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
                ],
                [
                    'judulbuku.required' => 'Judul Buku jawib diisi',
                    'kategori.required' => 'Kategori Wajib diisi',
                    'pengarang.required' => 'Pengarang Wajib diisi',
                    'isbn.required' => 'ISBN Wajib diisi',
                    'jmlhal.required' => 'Jumlah halaman Wajib diisi',
                    'jmlbuku.required' => 'Jumlah Buku Wajib diisi',
                    'thnterbit.required' => 'Tahun terbit Wajib diisi',
                    'sinopsis.required' => 'Sinopsis Wajib diisi',
                    'penerbit.required' => 'Penerbit Wajib diisi',
                    'rak.required' => 'RAK Wajib diisi',
                    'image.required' => 'Gambar Wajib diisi, max size 2 Mb',
                ]
            );
            if ($validator->fails()) {
                return redirect()->route('master.create')
                    ->withErrors($validator)
                    ->withInput();
            }
            $filename = trim($request->file('image')->getClientOriginalName());
            $data = DB::table('ms_databuku')->where('image', $filename)->first();
            if (is_null($data)) {
                DB::beginTransaction();
                $hasil =  DB::table('ms_databuku')->insert([
                    'judul_buku' => $request->input('judulbuku'),
                    'kategori' => $request->input('kategori'),
                    'pengarang' => $request->input('pengarang'),
                    'isbn' => $request->input('isbn'),
                    'jml_hal' => $request->input('jmlhal'),
                    'jml_buku' => $request->input('jmlbuku'),
                    'thn_terbit' => $request->input('thnterbit'),
                    'sinopsis' => $request->input('sinopsis'),
                    'penerbit' => $request->input('penerbit'),
                    'rak' => $request->input('rak'),
                    'image' => $filename
                ]);
                DB::commit();
                $request->image->move(public_path('images'), $filename);
                if ($hasil) {
                    return back()->with(['success' => 'Data berhasil disimpan !']);
                }
            } else {
                return back()->with(['warning' => 'Nama File Gambar sudah ada, silahkan diganti'])->withInput();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $e->getMessage();
        }
    }
}
