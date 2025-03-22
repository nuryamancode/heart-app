<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =[
            'video' => Video::first()
        ];
        return view('user.test-page', $data);
    }

    public function start()
    {
        $test = Test::where([
            'user_id' => Auth::user()->id,
            'status' => 'belum'
        ])->first();

        if (!$test) {
            $test = Test::create([
                'user_id' => Auth::user()->id
            ]);
        }

        return redirect()->route('soal-1', $test->id);
    }

    public function soal_1(Test $test)
    {
        return view('user.test.soal-1', [
            'test' => $test
        ]);
    }

    public function soal_2(Test $test, Request $request)
    {
        $test->update([
            'age' => (int) $request->age > 45 ? 2 : 1,
            'gender' => $request->gender == 'wanita' ? 0 : 1
        ]);

        return view('user.test.soal-2', [
            'test' => $test
        ]);
    }

    public function soal_3(Test $test, Request $request)
    {
        $test->update([
            'soal_2' => $request->choice,
        ]);

        return view('user.test.soal-3', [
            'test' => $test
        ]);
    }

    public function soal_4(Test $test, Request $request)
    {
        $test->update([
            'soal_3' => $request->choice,
        ]);

        return view('user.test.soal-4', [
            'test' => $test
        ]);
    }

    public function soal_5(Test $test, Request $request)
    {
        $test->update([
            'soal_4' => $request->choice,
        ]);

        return view('user.test.soal-5', [
            'test' => $test
        ]);
    }

    public function soal_6(Test $test, Request $request)
    {
        $test->update([
            'soal_5' => $request->choice,
        ]);

        return view('user.test.soal-6', [
            'test' => $test
        ]);
    }

    public function soal_7(Test $test, Request $request)
    {
        $test->update([
            'soal_6' => $request->choice,
        ]);

        return view('user.test.soal-7', [
            'test' => $test
        ]);
    }

    public function soal_8(Test $test, Request $request)
    {
        $test->update([
            'soal_7' => $request->choice,
        ]);

        return view('user.test.soal-8', [
            'test' => $test
        ]);
    }

    public function soal_9(Test $test, Request $request)
    {
        $test->update([
            'soal_8' => $request->choice,
        ]);

        return view('user.test.soal-9', [
            'test' => $test
        ]);
    }

    public function soal_10(Test $test, Request $request)
    {
        $test->update([
            'soal_9' => $request->choice,
        ]);

        return view('user.test.soal-10', [
            'test' => $test
        ]);
    }

    public function soal_11(Test $test, Request $request)
    {
        $test->update([
            'soal_10' => $request->choice,
        ]);

        return view('user.test.soal-11', [
            'test' => $test
        ]);
    }

    public function soal_12(Test $test, Request $request)
    {
        $test->update([
            'soal_11' => $request->choice,
        ]);

        return view('user.test.soal-12', [
            'test' => $test
        ]);
    }

    public function soal_13(Test $test, Request $request)
    {
        $test->update([
            'soal_12' => $request->choice,
        ]);

        return view('user.test.soal-13', [
            'test' => $test
        ]);
    }

    public function result(Test $test, Request $request)
    {
        $test->update([
            'soal_13' => $request->choice,
            'status' => 'sudah'
        ]);

        $test->refresh();

        if (
            is_null($test->age) || is_null($test->gender) ||
            is_null($test->soal_2) || is_null($test->soal_3) || is_null($test->soal_4) ||
            is_null($test->soal_5) || is_null($test->soal_6) || is_null($test->soal_7) ||
            is_null($test->soal_8) || is_null($test->soal_9) || is_null($test->soal_10) ||
            is_null($test->soal_11) || is_null($test->soal_12) || is_null($test->soal_13)
        ) {
            Alert::error('Error', 'Data belum lengkap');
            return redirect()->back();
        }

        $score = $test->age + $test->gender + $test->soal_2 + $test->soal_3 + $test->soal_4 + $test->soal_5 + $test->soal_6 + $test->soal_7 + $test->soal_8 + $test->soal_9 + $test->soal_10 + $test->soal_11 + $test->soal_12 + $test->soal_13;

        $test->update([
            'score' => (int) ceil($score / 2)
        ]);

        return view('user.test-page-result', [
            'test' => $test
        ]);
    }


    // Test Manual Admin
    public function testManual(){
        return view('admin.page.test-manual');
    }
}
