<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'jadwal' => Jadwal::all()
        ];
        return view('admin.page.jadwal-dokter', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.add.add-jadwal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => [
                'required',
            ],
            'hari_awal' => [
                'required',
            ],
            'jam_awal' => [
                'required',
            ],
            'jam_akhir' => [
                'required',
            ],
            'foto' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048',
            ],
        ], [
            'nama_dokter.required' => 'Nama Dokter wajib diisi.',
            'hari_awal.required' => 'Hari Awal wajib diisi.',
            'jam_awal.required' => 'Jam Awal wajib diisi.',
            'jam_akhir.required' => 'Jam Akhir wajib diisi.',
            'foto.required' => 'Foto wajib diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, jpg, atau png.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);
        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('images/dokter'), $filename);
        Jadwal::create([
            'nama_dokter' => $request->nama_dokter,
            'hari_awal' => $request->hari_awal,
            'hari_akhir' => $request->hari_akhir,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'foto' => $filename,
            'sibuk' => $request->sibuk ? 1 : 0,
            'kosong' => $request->kosong ? 1 : 0
        ]);
        Alert::success('Success', 'Jadwal berhasil ditambahkan');
        return redirect()->route('jadwal-dokter');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'jadwal' => Jadwal::where('id', $id)->first()
        ];
        return view('admin.page.edit.edit-jadwal', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwalId = Jadwal::where('id', $id)->first();
        $request->validate([
            'nama_dokter' => [
                'required',
            ],
            'hari_awal' => [
                'required',
            ],
            'jam_awal' => [
                'required',
            ],
            'jam_akhir' => [
                'required',
            ],
            'foto' => [
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048',
            ],
        ], [
            'nama_dokter.required' => 'Nama Dokter wajib diisi.',
            'hari_awal.required' => 'Hari Awal wajib diisi.',
            'jam_awal.required' => 'Jam Awal wajib diisi.',
            'jam_akhir.required' => 'Jam Akhir wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, jpg, atau png.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);
        if ($request->hasFile('foto')) {
            if ($jadwalId->foto && file_exists(public_path('images/dokter/' . $jadwalId->foto))) {
                unlink(public_path('images/dokter/' . $jadwalId->foto));
            }
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('images/dokter'), $filename);
            $jadwalId->foto = $filename;
        }
        $jadwalId->nama_dokter = $request->nama_dokter;
        $jadwalId->hari_awal = $request->hari_awal;
        $jadwalId->hari_akhir = $request->hari_akhir;
        $jadwalId->jam_awal = $request->jam_awal;
        $jadwalId->jam_akhir = $request->jam_akhir;
        $jadwalId->sibuk = $request->sibuk ? 1 : 0;
        $jadwalId->kosong = $request->kosong ? 1 : 0;
        $jadwalId->save();
        Alert::success('Success', 'Jadwal berhasil diubah');
        return redirect()->route('jadwal-dokter');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwalId = Jadwal::where('id', $id)->first();
        if ($jadwalId->foto && file_exists(public_path('images/dokter/' . $jadwalId->foto))) {
            unlink(public_path('images/dokter/' . $jadwalId->foto));
        }
        $jadwalId->delete();
        Alert::success('Success', 'Jadwal berhasil dihapus');
        return redirect()->route('jadwal-dokter');
    }
}
