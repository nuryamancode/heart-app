<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'video' => Video::all()
        ];
        return view('admin.page.tutorial-video', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.add.add-video');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4|max:10024',
        ], [
            'required' => 'Video wajib diunggah.',
            'mimes' => 'Video harus berformat mp4.',
            'max' => 'Ukuran video maksimal 10 MB.',
        ]);
        $video = $request->file('video');
        $filename = time() . '_' . $video->getClientOriginalName();
        $video->move(public_path('video'), $filename);

        Video::create([
            'video' => $filename
        ]);
        Alert::success('Success', 'Video berhasil ditambahkan');
        return redirect()->route('tutorial-video');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = Video::where('id', $id)->first();
        return view('admin.page.edit.edit-video', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $videoId = Video::where('id', $id)->first();
        $request->validate([
            'video' => 'required|mimes:mp4|max:10024',
        ], [
            'required' => 'Video wajib diunggah.',
            'mimes' => 'Video harus berformat mp4.',
            'max' => 'Ukuran video maksimal 10 MB.',
        ]);
        if ($request->hasFile('video')) {
            if ($videoId->foto && file_exists(public_path('video/' . $videoId->foto))) {
                unlink(public_path('video/' . $videoId->foto));
            }
            $video = $request->file('video');
            $filename = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('video'), $filename);
            $videoId->video = $filename;
        }
        $videoId->save();
        Alert::success('Success', 'Video berhasil diupdate');
        return redirect()->route('tutorial-video');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $videoId = Video::where('id', $id)->first();
        if ($videoId) {
            if ($videoId->video && file_exists(public_path('video/' . $videoId->video))) {
                unlink(public_path('video/' . $videoId->video));
            }
            $videoId->delete();
            Alert::success('Success', 'Video berhasil dihapus');
            return redirect()->back();
        }
    }
}
