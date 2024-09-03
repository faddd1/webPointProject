<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KategoriController;

// --------------------- PAGE ROUTES ------------------------ //


// List Pelanggaran



// --------------------- AUTHENTICATION ---------------------- //

// Guest Middleware: Hanya bisa diakses oleh pengguna yang belum login
// Route::middleware(['guest'])->group(function() {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
// });

// Auth Middleware: Hanya bisa diakses oleh pengguna yang sudah login
Route::group(['middleware' => 'auth', 'userAkses:admin,guru,petugas,siswa'], function() {


});
    
    // Logout
    Route::get('/logout', [SesiController::class, 'logout']);

    // Dashboard Routes
    Route::get('dashboard/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('dashboard/guru', [AdminController::class, 'guru'])->middleware('userAkses:guru');
    Route::get('dashboard/petugas', [AdminController::class, 'petugas'])->middleware('userAkses:petugas');
    Route::get('dashboard/siswa', [AdminController::class, 'siswa'])->middleware('userAkses:siswa');
    

    

    Route::middleware(['auth', 'userAkses:admin,guru,petugas'])->group(function() {

            Route::get('/teacher', [TeacherController::class, 'index'])->name('data.guru');
            Route::get('/teacher/create', [TeacherController::class, 'create'])->name('create.guru');
            Route::post('/teacher/store', [TeacherController::class, 'store'])->name('store.guru');
            Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('edit.guru');
            Route::put('/teacher/update/{id}', [TeacherController::class, 'update'])->name('update.guru');
            Route::delete('/teacher/destroy/{id}', [TeacherController::class, 'destroy'])->name('destroy.guru');
             // Kategori Pelanggaran Routes
            Route::get('/kategoripelanggaran', [KategoriController::class, 'index']);
            Route::get('/kategoripelanggaran/search', [KategoriController::class, 'searchkategori'])->name('pelanggaran.search');
            Route::get('/kategoripelanggaran/create', [KategoriController::class, 'create']);
            Route::get('kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
            Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
            Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
            Route::post('/kategoripelanggaran/store', [KategoriController::class, 'store'])->name('kategori.store');

            Route::get('/datasiswa', [StudentController::class, 'indexdata'])->name('datasiswa');
            Route::get('/datasiswa/create', [StudentController::class, 'create'])->name('datasiswa/create');
            Route::post('/datasiswa/store', [StudentController::class, 'store'])->name('datasiswa.store');
            Route::get('/datasiswa/edit/{id}', [StudentController::class, 'edit'])->name('datasiswa.edit');
            Route::put('/datasiswa/update/{id}', [StudentController::class, 'update'])->name('datasiswa.update');
            Route::delete('/datasiswa/destroy/{id}', [StudentController::class, 'destroy'])->name('datasiswa.destroy');
            Route::get('/cari-siswa', [StudentController::class, 'search'])->name('siswa.search');


            Route::get('/listpelanggaran', [StudentController::class, 'index'])->name('listpelanggaran.index');


              
        // Laporan
        Route::post('/lapor', [LaporanController::class, 'store'])->name('lapor.store');
        Route::get('/laporan', [LaporanController::class, 'index']);
           
    

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
          Route::get('/kategoripelanggaran/search', [KategoriController::class, 'searchkategori'])->name('pelanggaran.search');
          Route::get('/kategoripelanggaran/create', [KategoriController::class, 'create']);
          Route::post('/kategoripelanggaran/store', [KategoriController::class, 'store'])->name('kategori.store');
          Route::get('/kategoripelanggaran/edit{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
          Route::put('/kategoripelanggaran/update{id}', [KategoriController::class, 'update'])->name('kategori.update');
          Route::delete('/kategoripelanggaran/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
          Route::get('/laporan/review', [LaporanController::class, 'showPendingReports'])->name('laporan.review');
          Route::put('/laporan/approve/{id}', [LaporanController::class, 'approveReport'])->name('laporan.approve');
          Route::post('/laporan/not-approve/{id}', [LaporanController::class, 'notApproveReport'])->name('laporan.notApprove');



      
    });
    
    // Profile Routes
    Route::get('/profile', [UserController::class, 'Profil']);
    Route::delete('/profile/store', [UserController::class, 'Profil']);

   


// // Redirect to dashboard after login
// Route::get('/home', function(){
//     return redirect('/dashboard');
// });
