<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ListPelanggaranController;
use App\Http\Models\Pelanggaran;

// --------------------- PAGE ROUTES ------------------------ //


// List Pelanggaran


Route::get('/listpelanggaran', [ListPelanggaranController::class, 'index']);
Route::post('/listpelanggaran', [ListPelanggaranController::class, 'store'])->name('listpelanggaran.store');
Route::get('/listpelanggaran/search', [ListpelanggaranController::class, 'search'])->name('listpelanggaran.search');



// --------------------- AUTHENTICATION ---------------------- //

// Guest Middleware: Hanya bisa diakses oleh pengguna yang belum login
Route::middleware(['guest'])->group(function() {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

// Auth Middleware: Hanya bisa diakses oleh pengguna yang sudah login
Route::group(['middleware' => 'auth', 'userAkses:admin,guru,petugas,siswa'], function() {
    
    // Logout
    Route::get('/logout', [SesiController::class, 'logout']);

    // Dashboard Routes
    Route::get('dashboard/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('dashboard/guru', [AdminController::class, 'guru'])->middleware('userAkses:guru');
    Route::get('dashboard/petugas', [AdminController::class, 'petugas'])->middleware('userAkses:petugas');
    Route::get('dashboard/siswa', [AdminController::class, 'siswa'])->middleware('userAkses:siswa');

    

    Route::middleware(['auth', 'userAkses:admin,guru,petugas'])->group(function() {

            // Resource Controllers
            Route::resource('student', StudentController::class);
            Route::resource('teacher', TeacherController::class);


             // Kategori Pelanggaran Routes
            Route::get('/kategoripelanggaran', [KategoriController::class, 'index']);
            Route::get('/kategoripelanggaran/search', [KategoriController::class, 'search'])->name('kategori.search');
            Route::get('/kategoripelanggaran/create', [KategoriController::class, 'create']);
            Route::get('kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
            Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
            Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
            Route::post('/kategoripelanggaran/store', [KategoriController::class, 'store'])->name('kategori.store');

           


            // Laporan
            Route::get('/laporan', function () {
                return view('laporan.laporan', [
                    'title' => 'Laporan'
                ]);
            });

            

    });

   

    // User Routes
    Route::middleware(['auth', 'userAkses:admin'])->group(function() {
        Route::get('/tambah', [UserController::class, 'index']);
        Route::get('tambah/user', [UserController::class, 'create']);
        Route::get('tambah/edit{id}', [UserController::class, 'edit'])->name('tambah.edit');
        Route::post('tambah/store', [UserController::class, 'store'])->name('tambah.store');
        Route::put('tambah/update{id}', [UserController::class, 'update'])->name('tambah.update');
        Route::get('tambah/destroy{id}', [UserController::class, 'destroy'])->name('tambah.destroy');

          // Kategori Pelanggaran Routes
          Route::get('/kategoripelanggaran', [KategoriController::class, 'index']);
          Route::get('/kategoripelanggaran/search', [KategoriController::class, 'search']);
          Route::get('/kategoripelanggaran/create', [KategoriController::class, 'create']);
          Route::post('/kategoripelanggaran/store', [KategoriController::class, 'store'])->name('kategori.store');
          Route::get('/kategoripelanggaran/edit{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
          Route::put('/kategoripelanggaran/update{id}', [KategoriController::class, 'update'])->name('kategori.update');
          Route::delete('/kategoripelanggaran/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');




        
        Route::get('/riwayat', function () {
            return view('laporan.riwayat', [
                'title' => 'Riwayat Laporan'
            ]);
        });
    });
    
    // Profile Routes
    Route::get('/profile', [UserController::class, 'Profil']);
    Route::delete('/profile/store', [UserController::class, 'Profil']);

   
});

// Redirect to dashboard after login
Route::get('/home', function(){
    return redirect('/dashboard');
});
