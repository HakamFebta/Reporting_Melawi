<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TandaTanganController extends Controller
{
    public function index()
    {
        return view('master.tandatangan');
    }
}
