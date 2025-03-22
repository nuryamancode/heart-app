<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $artikel = Artikel::orderBy('created_at', 'desc')->paginate(5);
        $jadwal = Jadwal::orderBy('created_at', 'desc')->get();
        $data = [
            'artikel' => $artikel,
            'jadwal' => $jadwal
        ];
        return view('user.home', $data);
    }

    public function detail($id){
        $artikel = Artikel::where('id', $id)->first();
        $data = [
            'artikel' => $artikel
        ];
        return view('user.detail-berita', $data);
    }
    public function berita()
    {
        $artikel = Artikel::orderBy('created_at', 'desc')->get();
        $data = [
            'artikel' => $artikel
        ];
        return view('user.berita', $data);
    }
}
