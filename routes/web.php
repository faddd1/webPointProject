<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// --------------------- PAGE ROUTES ------------------------ //
   
Route::get('/', [HomeController::class, 'home'])->name('home');

// Rute Autentikasi
Route::get('/login', [SesiController::class, 'index'])->name('login');
Route::post('/login', [SesiController::class, 'login']);

// Rute Logout
Route::get('/logout', [SesiController::class, 'logout'])->name('logout');

// Auth Middleware: Hanya bisa diakses oleh pengguna yang sudah login
Route::group(['middleware' => ['auth', 'userAkses:admin,guru,petugas,siswa']], function () {
    // Profile Routes
    Route::get('/profile', [UserController::class, 'Profil'])->name('profile');
    Route::delete('/profile/store', [UserController::class, 'Profil']);

    // Dashboard Routes
    Route::get('dashboard/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('dashboard/guru', [AdminController::class, 'guru'])->middleware('userAkses:guru');
    Route::get('dashboard/petugas', [AdminController::class, 'petugas'])->middleware('userAkses:petugas');
    Route::get('dashboard/siswa', [AdminController::class, 'siswa'])->middleware('userAkses:siswa')->name('dashboard.siswa');
});

Route::middleware(['auth', 'userAkses:admin,guru,petugas'])->group(function () {
    // Kategori Pelanggaran Routes
    Route::get('/kategoripelanggaran', [KategoriController::class, 'index']);
    Route::get('/kategoripelanggaran/search/kategori', [KategoriController::class, 'searchkategori'])->name('pelanggaran.search');
    Route::get('/kategoripelanggaran/search', [KategoriController::class, 'search']);
    // List Pelanggaran Routes
    Route::get('/listpelanggaran', [StudentController::class, 'index'])->name('listpelanggaran.index');
    Route::get('/datasiswa/search', [StudentController::class, 'search'])->name('siswa.search');
    Route::get('/student/searchSiswa', [StudentController::class, 'searchSiswa'])->name('student.searchSiswa');
    Route::get('/listpelanggaran/show/{id}', [StudentController::class, 'show'])->name('listpelanggaran.show');
    Route::delete('/listpelanggaran/{id}}', [StudentController::class, 'listDestroy'])->name('listpelanggaran.destroy');
    // Laporan Routes
    Route::post('/lapor', [LaporanController::class, 'store'])->name('lapor.store');
    Route::get('/laporan', [LaporanController::class, 'index']);
    // Datapetugas Routes
    Route::get('/datapetugas', [PetugasController::class, 'tampil'])->name('petugas.tampil');
});

Route::middleware(['auth', 'userAkses:admin,guru'])->group(function () {
    // Teacher Routes
    Route::get('/teacher', [TeacherController::class, 'index'])->name('dataguru');
    Route::get('/teacher/search', [TeacherController::class, 'search'])->name('teacher.search');
    // Student Data Routes
    Route::get('/datasiswa', [StudentController::class, 'indexdata'])->name('datasiswa');
    Route::get('/datasiswa/show/{id}', [StudentController::class, 'showsiswa'])->name('datasiswa.show');

});

Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    // User Management Routes
    Route::get('/tambah', [UserController::class, 'index']);
    Route::get('tambah/user', [UserController::class, 'create']);
    Route::get('tambah/edit{id}', [UserController::class, 'edit'])->name('tambah.edit');
    Route::post('tambah/store', [UserController::class, 'store'])->name('tambah.store');
    Route::put('tambah/update{id}', [UserController::class, 'update'])->name('tambah.update');
    Route::get('tambah/destroy{id}', [UserController::class, 'destroy'])->name('tambah.destroy');
    // Laporan Review Routes
    Route::get('/dashboard', [LaporanController::class, 'getNotifications'])->name('dashboard');
    Route::get('/laporan/review', [LaporanController::class, 'showlaporan'])->name('laporan.review');
    Route::put('/laporan/approve/{id}', [LaporanController::class, 'terimalaporan'])->name('laporan.approve');
    Route::post('/laporan/not-approve/{id}', [LaporanController::class, 'tolaklaporan'])->name('laporan.notApprove');
    Route::get('/laporan/show/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    // Teacher Management Routes
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('create.guru');
    Route::post('/teacher/store', [TeacherController::class, 'store'])->name('store.guru');
    Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('edit.guru');
    Route::put('/teacher/update/{id}', [TeacherController::class, 'update'])->name('update.guru');
    Route::delete('/teacher/destroy/{id}', [TeacherController::class, 'destroy'])->name('destroy.guru');
    // Student Management Routes
    Route::get('/datasiswa/create', [StudentController::class, 'create'])->name('datasiswa.create');
    Route::post('/datasiswa/store', [StudentController::class, 'store'])->name('datasiswa.store');
    Route::get('/datasiswa/edit/{id}', [StudentController::class, 'edit'])->name('datasiswa.edit');
    Route::put('/datasiswa/update/{id}', [StudentController::class, 'update'])->name('datasiswa.update');
    Route::delete('/datasiswa/destroy/{id}', [StudentController::class, 'destroy'])->name('datasiswa.destroy');
    Route::delete('/datasiswa/hapus/point', [StudentController::class, 'hapusPoint'])->name('hapus.point');
    // Kategori Pelanggaran Management Routes
    Route::get('/kategoripelanggaran/create', [KategoriController::class, 'create']);
    Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::post('/kategoripelanggaran/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategoripelanggaran/search', [KategoriController::class, 'search'])->name('kategori.search');
    // Petugas Management Routes
    Route::get('/datapetugas/tambah', [PetugasController::class, 'tambah'])->name('petugas.create');
    Route::post('/datapetugas/submit', [PetugasController::class, 'submit'])->name('petugas.submit');
    Route::get('/datapetugas/edit/{id}', [PetugasController::class, 'edit'])->name('petugas.edit');
    Route::post('/datapetugas/update{id}', [PetugasController::class, 'update'])->name('petugas.update');
    Route::post('/datapetugas/delete{id}', [PetugasController::class, 'delete'])->name('petugas.delete');
    Route::get('/datapetugas/search', [PetugasController::class, 'search'])->name('petugas.search');
});

Route::middleware(['auth', 'userAkses:siswa'])->group(function () {
    Route::get('/listpelanggaran/siswa',[UserController::class, 'listsiswa'])->name('listsiswa');
});
