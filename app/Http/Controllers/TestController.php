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
    protected $callresponse;
    public function __construct(ResponseController $respone)
    {
        $this->callresponse = $respone;
    }

    public function index()
    {
        $data = [
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
    public function testManual()
    {
        return view('admin.page.test-manual');
    }

    public function result_test(Request $request)
    {
        $user_id = $request->user_id;
        $ageAsli = $request->age;
        $gender = $request->gender == 'wanita' ? 0 : 1;
        $soal_2 = $request->soal[2] == 'Ya' ? 1 : 0;
        $soal_3 = $request->soal[3] == 'Ya' ? 1 : 0;
        $soal_4 = $request->soal[4] == 'Ya' ? 1 : 0;
        $soal_5 = $request->soal[5] == 'Ya' ? 2 : 0;
        $soal_6 = $request->soal[6] == 'Ya' ? 1 : 0;
        $soal_7 = $request->soal[7] == 'Ya' ? 1 : 0;
        $soal_8 = $request->soal[8] == 'Ya' ? 1 : 0;
        $soal_9 = $request->soal[9] == 'Ya' ? 1 : 0;
        $soal_10 = $request->soal[10] == 'Ya' ? 5 : 0;
        $soal_11 = $request->soal[11] == 'Ya' ? 2 : 0;
        $soal_12 = $request->soal[12] == 'Ya' ? 2 : 0;
        $soal_13 = $request->soal[13] == 'Ya' ? 2 : 0;

        $age = (int) $request->age > 45 ? 2 : 1;
        $gender = $request->gender == 'wanita' ? 0 : 1;
        $count_soal = $soal_2 + $soal_3 + $soal_4 + $soal_5 + $soal_6 + $soal_7 + $soal_8 + $soal_9 + $soal_10 + $soal_11 + $soal_12 + $soal_13;

        $score = $age + $gender + $count_soal;

        $test = Test::create([
            'user_id' => $user_id,
            'age' => $ageAsli,
            'gender' => $gender,
            'soal_2' => $soal_2,
            'soal_3' => $soal_3,
            'soal_4' => $soal_4,
            'soal_5' => $soal_5,
            'soal_6' => $soal_6,
            'soal_7' => $soal_7,
            'soal_8' => $soal_8,
            'soal_9' => $soal_9,
            'soal_10' => $soal_10,
            'soal_11' => $soal_11,
            'soal_12' => $soal_12,
            'soal_13' => $soal_13,
            'status' => 'sudah',
            'score' => (int) ceil($score / 2)
        ]);

        return $this->callresponse->response(
            'Test selesai',
            $test,
            true
        );
    }

    public function history_test($user_id)
    {
        $test = Test::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return $this->callresponse->response(
            'Test selesai',
            $test,
            true
        );
    }
}
