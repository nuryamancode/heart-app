<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Artikel;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'artikelCount' => Artikel::count(),
            'jadwalCount' => Jadwal::count(),
            'noAntrianCount' => Antrian::count(),
            'antrian'=> Antrian::where('status', 1)->paginate(5)
        ];
        return view('admin.page.dashboard', $data);
    }
}
