<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'antrian' => Antrian::all()
        ];
        return view('admin.page.no-antrian', $data);
    }
    public function monitoring()
    {
        $data = [
            'antrian' => Antrian::all()
        ];
        return view('admin.page.monitoring-antrian', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.add.add-no-antrian');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_antrian' => [
                'required',
                'integer',
                'min:1',
                'max:100',
                'unique:antrians,no_antrian',
            ],
            'foto' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048',
            ],
        ], [
            'no_antrian.required' => 'Nomor antrian wajib diisi.',
            'no_antrian.integer' => 'Nomor antrian harus berupa angka.',
            'no_antrian.min' => 'Nomor antrian tidak boleh kurang dari 1.',
            'no_antrian.max' => 'Nomor antrian tidak boleh lebih dari 100.',
            'no_antrian.unique' => 'Nomor antrian ini sudah ada, silakan gunakan nomor lain.',
            'foto.required' => 'Foto wajib diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, jpg, atau png.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);


        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('images/number'), $filename);
        Antrian::create([
            'no_antrian' => $request->no_antrian,
            'foto' => $filename
        ]);

        Alert::success('Success', 'Antrian berhasil ditambahkan');
        return redirect()->route('no-antrian');
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
        $antrianId = Antrian::where('id', $id)->first();
        $data = [
            'antrian' => $antrianId
        ];
        return view('admin.page.edit.edit-no-antrian', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $antrianId = Antrian::where('id', $id)->first();
        $request->validate([
            'no_antrian' => [
                'required',
                'integer',
                'min:1',
                'max:100',
                'unique:antrians,no_antrian,' . $antrianId->id,
            ],
            'foto' => [
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048',
            ],
        ], [
            'no_antrian.integer' => 'Nomor antrian harus berupa angka.',
            'no_antrian.min' => 'Nomor antrian tidak boleh kurang dari 1.',
            'no_antrian.max' => 'Nomor antrian tidak boleh lebih dari 100.',
            'no_antrian.unique' => 'Nomor antrian ini sudah ada, silakan gunakan nomor lain.',
            'foto.required' => 'Foto wajib diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpeg, jpg, atau png.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($antrianId->foto && file_exists(public_path('images/number/' . $antrianId->foto))) {
                unlink(public_path('images/number/' . $antrianId->foto));
            }
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('images/number'), $filename);
            $antrianId->foto = $filename;
        }
        $antrianId->no_antrian = $request->no_antrian;
        $antrianId->save();
        Alert::success('Success', 'Antrian berhasil diupdate');
        return redirect()->route('no-antrian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $antrianId = Antrian::where('id', $id)->first();
        if ($antrianId) {
            if ($antrianId->foto && file_exists(public_path('images/number/' . $antrianId->foto))) {
                unlink(public_path('images/number/' . $antrianId->foto));
            }
            $antrianId->delete();
            Alert::success('Success', 'Antrian berhasil dihapus');
            return redirect()->back();
        }
    }


    // User FE
    public function antrian()
    {
        $data = [
            'antrian' => Antrian::all(),
            'jadwal' => Jadwal::orderBy('created_at', 'desc')->get()

        ];
        return view('user.antrian', $data);
    }
}

