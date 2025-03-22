<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'artikel' => Artikel::all()
        ];
        return view('admin.page.artikel', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.add.add-artikel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => [
                'required',
            ],
            'isi' => [
                'required',
            ],
            'foto' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048',
            ],
        ], [
            'judul.required' => 'Judul Artikel wajib diisi.',
            'isi.required' => 'Deskripsi wajib diisi.',
            'foto.required' => 'Foto wajib diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, jpg, atau png.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);


        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('images/artikel'), $filename);
        Artikel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $filename
        ]);

        Alert::success('Success', 'Antrian berhasil ditambahkan');
        return redirect()->route('artikel');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikelId = Artikel::where('id', $id)->first();
        return view('admin.page.edit.edit-artikel', compact('artikelId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $artikelId = Artikel::where('id', $id)->first();
        $request->validate([
            'judul' => [
                'required',
            ],
            'isi' => [
                'required',
            ],
            'foto' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048',
            ],
        ], [
            'judul.required' => 'Judul Artikel wajib diisi.',
            'isi.required' => 'Deskripsi wajib diisi.',
            'foto.required' => 'Foto wajib diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, jpg, atau png.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);
        if ($request->hasFile('foto')) {
            if ($artikelId->foto && file_exists(public_path('images/artikel/' . $artikelId->foto))) {
                unlink(public_path('images/artikel/' . $artikelId->foto));
            }
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('images/artikel'), $filename);
            $artikelId->foto = $filename;
        }
        $artikelId->judul = $request->judul;
        $artikelId->isi = $request->isi;
        $artikelId->save();
        Alert::success('Success', 'Artikel berhasil diubah');
        return redirect()->route('artikel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artikelId = Artikel::where('id', $id)->first();
        if ($artikelId->foto && file_exists(public_path('images/artikel/' . $artikelId->foto))) {
            unlink(public_path('images/artikel/' . $artikelId->foto));
        }
        $artikelId->delete();
        Alert::success('Success', 'Artikel berhasil dihapus');
        return redirect()->route('artikel');
    }
}
