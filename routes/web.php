<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;


// ---------------PAGE------------------- //


// DATASISWA



// KATEGORI PELANGGARAN
 
// LAPORAN
Route::get('/laporan', function () {
    return view('laporan.laporan',
    [
        'title' => 'Laporan'
    ]);
});

Route::get('/riwayat', function () {
    return view('laporan.riwayat',
    [
        'title' => 'Riwayat Laporan'
    ]);
});

// LIST PELANGGARAN
Route::get('/listpelanggaran', function () {
    return view('listpelanggaran.listpelanggaran',
    [
        'title' => 'List Pelanggaran'
    ]);
});


Route::middleware(['guest'])->group(function() {

    Route::get('', [SesiController::class, 'index'])->name('login');
    Route::post('', [SesiController::class, 'login']);
    
});

Route::group(['middleware' => 'auth', 'userAkses:admin,guru,petugas,siswa'], function(){
    Route::get('/logout', [SesiController::class, 'logout']);
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('dashboard/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('dashboard/guru', [AdminController::class, 'guru'])->middleware('userAkses:guru');
    Route::get('dashboard/petugas', [AdminController::class, 'petugas'])->middleware('userAkses:petugas');
    Route::get('dashboard/siswa', [AdminController::class, 'siswa'])->middleware('userAkses:siswa');
    Route::resource('student', StudentController::class);
    Route::resource('teacher', TeacherController::class);

    Route::get('/tambah' , [UserController::class, 'index']);
    Route::get('tambah/user', [UserController::class, 'create']);
    Route::get('tambah/edit{id}', [UserController::class, 'edit'])->name('tambah.edit');
    Route::post('tambah/store', [UserController::class, 'store'])->name('tambah.store');
    Route::put('tambah/update{id}', [UserController::class, 'update'])->name('tambah.update');
    Route::get('tambah/destroy{id}', [UserController::class, 'destroy'])->name('tambah.destroy');


    Route::get('/profile', [UserController::class, 'Profil']);
    Route::delete('/profile/store', [UserController::class, 'Profil']);

    Route::get('/kategoripelanggaran', [KategoriController::class, 'index']);
    Route::get('/kategoripelanggaran/search', [KategoriController::class, 'search']);
    Route::get('/kategoripelanggaran/create', [KategoriController::class, 'create']);
    Route::post('/kategoripelanggaran/store', [KategoriController::class, 'store'])->name('kategori.store');
});

Route::get('/logout', [SesiController::class, 'logout']);

Route::get('/home', function(){
    return redirect('/dashboard');
});


