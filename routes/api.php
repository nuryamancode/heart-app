<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/signin', [AuthController::class, 'login_api']);
Route::post('/signup', [AuthController::class, 'register_api']);
Route::get('/berita', [ArtikelController::class, 'berita']);
Route::get('/detail-berita/{id}', [ArtikelController::class, 'berita_detail']);
Route::get('/jadwal', [JadwalController::class, 'jadwal']);
Route::get('/video-tutorial', [VideoController::class, 'video_tutorial']);
Route::get('/antrian', [AntrianController::class, 'antrian']);

Route::post('/update-profile/{id}', [ProfileController::class, 'updateProfile']);


// Home Page & Berita & Detail Berita


// Soal
Route::get('/soal-1/{test}', [TestController::class, 'soal_1'])->name('soal-1');
Route::get('/soal-2/{test}', [TestController::class, 'soal_2'])->name('soal-2');
Route::get('/soal-3/{test}', [TestController::class, 'soal_3'])->name('soal-3');
Route::get('/soal-4/{test}', [TestController::class, 'soal_4'])->name('soal-4');
Route::get('/soal-5/{test}', [TestController::class, 'soal_5'])->name('soal-5');
Route::get('/soal-6/{test}', [TestController::class, 'soal_6'])->name('soal-6');
Route::get('/soal-7/{test}', [TestController::class, 'soal_7'])->name('soal-7');
Route::get('/soal-8/{test}', [TestController::class, 'soal_8'])->name('soal-8');
Route::get('/soal-9/{test}', [TestController::class, 'soal_9'])->name('soal-9');
Route::get('/soal-10/{test}', [TestController::class, 'soal_10'])->name('soal-10');
Route::get('/soal-11/{test}', [TestController::class, 'soal_11'])->name('soal-11');
Route::get('/soal-12/{test}', [TestController::class, 'soal_12'])->name('soal-12');
Route::get('/soal-13/{test}', [TestController::class, 'soal_13'])->name('soal-13');

// Test Page & Test Result
Route::get('/test-page-result/{test}', [TestController::class, 'result'])->name('test-page-result');

// Antrian
// Antrian

// Riwayat
Route::get('/riwayat', [HistoryController::class, 'index'])->name('riwayat');
Route::get('/test-detail', function () {
    return view('user.test-detail');
})->name('test-detail');
// Riwayat

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'store']);
// Profile

// Chat
Route::group(['prefix' => 'user'], function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat-admin');
    Route::get('/fetch-message', [ChatController::class, 'fetchMessagesFromUserToAdmin'])->name('fetch.to-admin');
    Route::post('/send-message', [ChatController::class, 'sendMessageFromUserToAdmin'])->name('send.to-admin');
});
// Chat