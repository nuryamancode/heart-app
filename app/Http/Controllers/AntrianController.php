<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AntrianController extends Controller
{
    protected $callresponse;
    public function __construct(ResponseController $respone)
    {
        $this->callresponse = $respone;
    }
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
        ], [
            'no_antrian.required' => 'Nomor antrian wajib diisi.',
            'no_antrian.integer' => 'Nomor antrian harus berupa angka.',
            'no_antrian.min' => 'Nomor antrian tidak boleh kurang dari 1.',
            'no_antrian.max' => 'Nomor antrian tidak boleh lebih dari 100.',
            'no_antrian.unique' => 'Nomor antrian ini sudah ada, silakan gunakan nomor lain.',
        ]);


        Antrian::create([
            'no_antrian' => $request->no_antrian,
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
        ], [
            'no_antrian.integer' => 'Nomor antrian harus berupa angka.',
            'no_antrian.min' => 'Nomor antrian tidak boleh kurang dari 1.',
            'no_antrian.max' => 'Nomor antrian tidak boleh lebih dari 100.',
            'no_antrian.unique' => 'Nomor antrian ini sudah ada, silakan gunakan nomor lain.',
        ]);

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
            $antrianId->delete();
            Alert::success('Success', 'Antrian berhasil dihapus');
            return redirect()->back();
        }
    }


    // User FE
    public function antrian()
    {
        try {
            $antrian = Antrian::orderBy('created_at', 'desc')->get();
            if ($antrian->isEmpty()) {
                return $this->callresponse->response(
                    'Antrian tidak ditemukan',
                    null,
                    false
                );
            }
            return $this->callresponse->response(
                'Antrian berhasil diambil',
                $antrian,
                true
            );
        } catch (\Throwable $th) {
            return $this->callresponse->response(
                $th->getMessage(),
                null,
                false
            );
        }
    }
}

