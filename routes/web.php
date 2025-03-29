<?php

use App\Events\ChatSen;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VideoController;
use App\Models\Antrian;
use Illuminate\Support\Facades\Route;

Broadcast::routes();

Route::get("/home", function () {
    if (Auth::check()) {
        return redirect("/dashboard");
    }else{
        return redirect("/login");
    }
});


Route::middleware('guest')->group(function () {
    // Route::get('/', function () {
    //     return view('auth.onboarding.onscreen-1');
    // })->name('on-screen-1');
    // Route::get('/on-screen-2', function () {
    //     return view('auth.onboarding.onscreen-2');
    // })->name('on-screen-2');
    // Route::get('/on-screen-3', function () {
    //     return view('auth.onboarding.onscreen-3');
    // })->name('on-screen-3');
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store']);


Route::middleware('auth')->group(function () {

    Route::get('/change-password', [ProfileController::class, 'profileAdmin'])->name('change-password');
    Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'admin/'], function () {
        Route::get('/chat', [ChatController::class, 'indexAdmin'])->name('chat');
        Route::get('/chat-room/{id}', [ChatController::class, 'ChatRoom'])->name('chat-room');
        Route::get('/fetch-admin', [ChatController::class, 'fetchMessages'])->name('fetch.to-user');
        Route::post('/mark-seen/{receiverId}', [ChatController::class, 'markMessagesAsSeen'])->name('mark.seen');
        Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.to-user');


    });
    Route::group(['prefix' => 'antrian'], function () {
        Route::get('/no-antrian', [AntrianController::class, 'index'])->name('no-antrian');
        Route::get('/add-no-antrian', [AntrianController::class, 'create'])->name('add-no-antrian');
        Route::get('/edit-no-antrian/{id}', [AntrianController::class, 'edit'])->name('edit-no-antrian');

        // Post Update Delete
        Route::post('/post-no-antrian', [AntrianController::class, 'store'])->name('post-no-antrian');
        Route::post('/update-no-antrian/{id}', [AntrianController::class, 'update'])->name('update-no-antrian');
        Route::post('/delete-no-antrian/{id}', [AntrianController::class, 'destroy'])->name('delete-no-antrian');
        Route::post('/delete-no-antrian-all', [AntrianController::class, 'deleteAllToday'])->name('delete-no-antrian-all');

    });

    Route::group(['prefix' => 'artikel'], function () {
        Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
        Route::get('/add-artikel', [ArtikelController::class, 'create'])->name('add-artikel');
        Route::get('/edit-artikel/{id}', [ArtikelController::class, 'edit'])->name('edit-artikel');

        // Post
        Route::post('/post-artikel', [ArtikelController::class, 'store'])->name('post-artikel');
        Route::post('/update-artikel/{id}', [ArtikelController::class, 'update'])->name('update-artikel');
        Route::post('/delete-artikel/{id}', [ArtikelController::class, 'destroy'])->name('delete-artikel');
    });
    Route::group(['prefix' => 'jadwal'], function () {
        Route::get('/jadwal-dokter', [JadwalController::class, 'index'])->name('jadwal-dokter');
        Route::get('/add-jadwal-dokter', [JadwalController::class, 'create'])->name('add-jadwal-dokter');
        Route::get('/edit-jadwal-dokter/{id}', [JadwalController::class, 'edit'])->name('edit-jadwal-dokter');

        // Post
        Route::post('/post-jadwal', [JadwalController::class, 'store'])->name('post-jadwal');
        Route::post('/update-jadwal/{id}', [JadwalController::class, 'update'])->name('update-jadwal');
        Route::post('/delete-jadwal/{id}', [JadwalController::class, 'destroy'])->name('delete-jadwal');

    });

    Route::group(['prefix' => 'video'], function () {
        Route::get('/video', [VideoController::class, 'index'])->name('tutorial-video');
        Route::get('/add-video', [VideoController::class, 'create'])->name('add-video');
        Route::get('/edit-video/{id}', [VideoController::class, 'edit'])->name('edit-video');

        // Post
        Route::post('/post-video', [VideoController::class, 'store'])->name('post-video');
        Route::post('/update-video/{id}', [VideoController::class, 'update'])->name('update-video');
        Route::post('/delete-video/{id}', [VideoController::class, 'destroy'])->name('delete-video');
    });

    Route::group(['prefix' => 'monitoring'], function () {
        Route::get('/monitoring-antrian', [AntrianController::class, 'monitoring'])->name('monitoring-antrian');

    });

    Route::group(['prefix' => 'test'], function () {
        Route::get('/test-manual', [TestController::class, 'testManual'])->name('test-manual');

    });

});

Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
