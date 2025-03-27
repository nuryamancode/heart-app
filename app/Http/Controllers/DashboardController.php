<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Artikel;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'artikelCount' => Artikel::count(),
            'jadwalCount' => Jadwal::count(),
            'noAntrianCount' => User::whereNot('id', Auth::user()->id)->count(),
        ];
        return view('admin.page.dashboard', $data);
    }
}
