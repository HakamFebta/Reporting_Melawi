<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\User;
use Session;

// Push again
class LoginController extends Controller
{

    public function index()
    {
        $data = [
            // 'background' => DB::connection('sqlsrv')->table('name_background_login')->select('nama_background')->first(),
            'daerah' => DB::connection('sqlsrv')->table('Config_aplikasi')->select('nama', 'kabupaten')->first()
        ];
        return view('login.index')->with($data);
    }

    public function actionlogin(Request $request)
    {

        $credentials = $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Username kosong',
                'password.required' => 'Password kosong',
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = DB::connection('sqlsrv')->table('Users')
                ->where(['username' => $request->username])
                ->first();
            if ($user->status == 1) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with('key', 'Username terkunci, silahkan hubungi admin');
            } else {
                Auth::logoutOtherDevices($request->input('password'));
                // return redirect()->route('reporting.dashboard');
                return redirect()->route('reporting.dashboardtahun');
                // return redirect()->to('dashboard');
            }
        }
        return back()->with('message', 'Username atau password salah')->onlyInput('username');
    }

    public function logout(Request $request)
    {
        $id_user = Auth::user()->id_user;
        DB::beginTransaction();
        DB::connection('sqlsrv')->table('Users_tahun')->where('id_users', '=', $id_user)->delete();
        DB::commit();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
