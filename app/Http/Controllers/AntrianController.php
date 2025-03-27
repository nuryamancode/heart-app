<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'no_antrian' => [
    //             'required',
    //             'integer',
    //             'min:1',
    //             'max:100',
    //             'unique:antrians,no_antrian',
    //         ],
    //     ], [
    //         'no_antrian.required' => 'Nomor antrian wajib diisi.',
    //         'no_antrian.integer' => 'Nomor antrian harus berupa angka.',
    //         'no_antrian.min' => 'Nomor antrian tidak boleh kurang dari 1.',
    //         'no_antrian.max' => 'Nomor antrian tidak boleh lebih dari 100.',
    //         'no_antrian.unique' => 'Nomor antrian ini sudah ada, silakan gunakan nomor lain.',
    //     ]);


    //     Antrian::create([
    //         'no_antrian' => $request->no_antrian,
    //     ]);

    //     Alert::success('Success', 'Antrian berhasil ditambahkan');
    //     return redirect()->route('no-antrian');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ], [
            'jumlah.required' => 'Jumlah antrian harus diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 1.',
        ]);

        $startingNoAntrian = $request->no_antrian;
        $jumlah = $request->jumlah;

        for ($i = 1; $i < $jumlah; $i++) {
            $newNoAntrian = 'A' . str_pad($startingNoAntrian + $i, 3, '0', STR_PAD_LEFT);

            Antrian::create([
                'no_antrian' => $newNoAntrian,
            ]);
        }

        Alert::success('Success', "{$jumlah} antrian berhasil ditambahkan.");
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
            $antrian = Antrian::orderBy('created_at', 'desc')->whereNull('user_id')->whereDate('created_at', Carbon::today())->get();
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

    public function ambil_antrian(Request $request)
    {
        $antrian_id = $request->antrian_id;
        $user_id = $request->user_id;

        try {
            DB::beginTransaction();
            $antrian = Antrian::where('user_id', $user_id)
                ->whereDate('created_at', Carbon::today())
                ->where(function ($query) {
                    $query->where('status', 1)->orWhere('status', 2);
                })
                ->first();

            $currentAntrian = Antrian::whereDate('created_at', Carbon::today())
                ->whereNull('user_id')
                ->get();

            if ($antrian) {
                return $this->callresponse->response(
                    'Anda sudah mengambil antrian hari ini',
                    $currentAntrian,
                    false
                );
            }

            $antrian = Antrian::where('id', $antrian_id)->whereNull('user_id')->first();
            if (!$antrian) {
                return $this->callresponse->response(
                    'Antrian tidak ditemukan',
                    $currentAntrian,
                    false
                );
            }

            $antrian->user_id = $user_id;
            $antrian->status = 1;
            $antrian->save();
            DB::commit();

            return $this->callresponse->response(
                'Antrian berhasil diambil',
                $currentAntrian,
                true
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->callresponse->response(
                $th->getMessage(),
                null,
                false
            );
        }
    }

    public function get_current_antrian($user_id)
    {
        $currentAntrian = Antrian::where('user_id', $user_id)
            ->whereDate('created_at', Carbon::today())
            ->whereIn('status', [1, 2])
            ->first();

        return $this->callresponse->response(
            'Antrian berhasil diambil',
            $currentAntrian,
            true
        );
    }

    public function get_history_antrian($user_id)
    {
        $historyAntrian = Antrian::where('user_id', $user_id)
            ->whereIn('status', [3, 4])
            ->get();

        return $this->callresponse->response(
            'Antrian berhasil diambil',
            $historyAntrian,
            true
        );
    }
}
