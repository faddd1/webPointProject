<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Sanksi;
use App\Http\Controllers\ListSiswa;
use App\Http\Controllers\Notifikasi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserGuruController;
use App\Http\Controllers\PenebusanController;
use App\Http\Controllers\UserSiswaController;
use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\UserPetugasController;
use App\Http\Controllers\PoinPenebusanController;
// --------------------- PAGE ROUTES ------------------------ //
   
Route::get('/', [HomeController::class, 'home'])->name('home');

//Kontak
Route::post('/kontak',[HomeController::class, 'send'])->name('send.email');

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

    Route::get('/tatatertib',[TataTertibController::class, 'tampilanTata']);
    //unduh data siswa
    Route::get('/download/tata-tertib', function () {
        $filePath = public_path('assets/pdf/TataTertib.pdf');
        $fileName = 'TataTertib_2024.pdf';
        return response()->download($filePath, $fileName);
    });
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
    // List Prestasi Siswa
    Route::get('/listprestasi', [StudentController::class, 'prestasi'])->name('listprestasi.prestasi');
    Route::get('/listprestasi/search', [PoinPenebusanController::class, 'search'])->name('listprestasi.search');
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

  // Poin Penebusan
  Route::get('/PoinPenebusan', [PoinPenebusanController::class, 'index'])->name('Poin.Penebusan');
  Route::post('/PoinPenebusan/store', [PoinPenebusanController::class, 'store'])->name('Poin.store');
  Route::get('/PoinPenebusan/create', [PoinPenebusanController::class, 'create'])->name('Poin.create');
  Route::get('/PoinPenebusan/edit/{id}', [PoinPenebusanController::class, 'edit'])->name('Poin.edit');
  Route::put('/PoinPenebusan/update/{id}', [PoinPenebusanController::class, 'update'])->name('Poin.update');
  Route::delete('/PoinPenebusan/destroy/{id}', [PoinPenebusanController::class, 'destroy'])->name('Poin.destroy');

  Route::get('/Penebusan', [PenebusanController::class, 'index'])->name('penebusan');
  Route::post('/Penebusan/store', [PenebusanController::class, 'store'])->name('penebusan.store');
  Route::get('/Penebusan/search', [PenebusanController::class, 'searchPenebusan'])->name('penebusan.search');

  Route::get('/penebusan/review', [PenebusanController::class, 'showpenebusan'])->name('penebusan.review');
  Route::put('/penebusan/approve/{id}', [PenebusanController::class, 'terimapenebusan'])->name('penebusan.approve');
  Route::post('/penebusan/not-approve/{id}', [PenebusanController::class, 'tolakpenebusan'])->name('penebusan.notApprove');
  Route::get('/penebusan/show/{id}', [PenebusanController::class, 'show'])->name('penebusan.show');

  Route::get('/export-pdf', [StudentController::class, 'exportPdf'])->name('data.pdf');
  Route::get('/export-excel', [StudentController::class, 'exportExcel'])->name('data.excel');
  //listpdf
  Route::get('/export-list-pdf', [StudentController::class, 'listPdf'])->name('list.pdf');
  
    //searchhukuman
  Route::get('/hukuman/search', [ListSiswa::class, 'search'])->name('hukuman.search');
  Route::get('/hukuman',[ListSiswa::class, 'index'])->name('hukuman');

  //pdfsanksi
  Route::get('/sanksi-pdf', [ListSiswa::class, 'sanksiPdf'])->name('sanksi.pdf');
    Route::get('/hukuman/sanksi', [Sanksi::class, 'sanksi'])->name('sanksi');



});

Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    // Akun Admin
    Route::get('/tambah', [UserController::class, 'index'])->name('tambah');
    Route::get('tambah/user', [UserController::class, 'create']);
    Route::get('tambah/edit{id}', [UserController::class, 'edit'])->name('tambah.edit');
    Route::post('tambah/store', [UserController::class, 'store'])->name('tambah.store');
    Route::put('tambah/update{id}', [UserController::class, 'update'])->name('tambah.update');
    Route::get('tambah/destroy{id}', [UserController::class, 'destroy'])->name('tambah.destroy');
    Route::get('tambahAdmin/search', [UserController::class, 'search'])->name('tambahAdmin.search');
    //Akun Petugas
    Route::get('/tambahPetugas', [UserPetugasController::class, 'index'])->name('tambahPetugas');
    Route::get('tambahPetugas/user', [UserPetugasController::class, 'create']);
    Route::get('tambahPetugas/edit{id}', [UserPetugasController::class, 'edit'])->name('tambahPetugas.edit');
    Route::post('tambahPetugas/store', [UserPetugasController::class, 'store'])->name('tambahPetugas.store');
    Route::put('tambahPetugas/update{id}', [UserPetugasController::class, 'update'])->name('tambahPetugas.update');
    Route::get('tambahPetugas/destroy{id}', [UserPetugasController::class, 'destroy'])->name('tambahPetugas.destroy');
    Route::get('tambahPetugas/search', [UserPetugasController::class, 'search'])->name('tambahPetugas.search');
    // Akun Siswa
    Route::get('/tambahSiswa', [UserSiswaController::class, 'index'])->name('tambahSiswa');
    Route::get('tambahSiswa/user', [UserSiswaController::class, 'create']);
    Route::get('tambahSiswa/edit{id}', [UserSiswaController::class, 'edit'])->name('tambahSiswa.edit');
    Route::post('tambahSiswa/store', [UserSiswaController::class, 'store'])->name('tambahSiswa.store');
    Route::put('tambahSiswa/update{id}', [UserSiswaController::class, 'update'])->name('tambahSiswa.update');
    Route::get('tambahSiswa/destroy{id}', [UserSiswaController::class, 'destroy'])->name('tambahSiswa.destroy');
    Route::get('tambahSiswa/search', [UserSiswaController::class, 'search'])->name('tambahSiswa.search');


    Route::get('/tambahGuru', [UserGuruController::class, 'index'])->name('tambahGuru');
    Route::get('tambahGuru/user', [UserGuruController::class, 'create']);
    Route::get('tambahGuru/edit{id}', [UserGuruController::class, 'edit'])->name('tambahGuru.edit');
    Route::post('tambahGuru/store', [UserGuruController::class, 'store'])->name('tambahGuru.store');
    Route::put('tambahGuru/update{id}', [UserGuruController::class, 'update'])->name('tambahGuru.update');
    Route::get('tambahGuru/destroy{id}', [UserGuruController::class, 'destroy'])->name('tambahGuru.destroy');
    Route::get('tambahGuru/search', [UserGuruController::class, 'search'])->name('tambahGuru.search');

    // Laporan Review Routee
    Route::get('/laporan/review', [LaporanController::class, 'showlaporan'])->name('laporan.review');
    Route::put('/laporan/approve/{id}', [LaporanController::class, 'terimalaporan'])->name('laporan.approve');
    Route::delete('/laporan/not-approve/{id}', [LaporanController::class, 'tolaklaporan'])->name('laporan.notApprove');
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
    Route::post('/kategoripelanggaran/tambah/pasal', [PasalController::class, 'createPasal'])->name('kategori.createPasal');
    Route::get('/kategoripelanggaran/pasal', [PasalController::class, 'createPasall'])->name('kategori.pasal');
    Route::get('/kategoripelanggaran/pasal/edit/{id}', [PasalController::class, 'editPasal'])->name('kategori.editPasal');
    Route::put('/kategoripelanggaran/pasal/update/{id}', [PasalController::class, 'updatePasal'])->name('kategori.updatePasal');
    Route::delete('/kategoripelanggaran/pasal/destroy/{id}', [PasalController::class, 'destroyPasal'])->name('kategori.destroyPasal');
    // Petugas Management Routes
    Route::get('/datapetugas/tambah', [PetugasController::class, 'tambah'])->name('petugas.create');
    Route::post('/datapetugas/submit', [PetugasController::class, 'submit'])->name('petugas.submit');
    Route::get('/datapetugas/edit/{id}', [PetugasController::class, 'edit'])->name('petugas.edit');
    Route::post('/datapetugas/update{id}', [PetugasController::class, 'update'])->name('petugas.update');
    Route::post('/datapetugas/delete{id}', [PetugasController::class, 'delete'])->name('petugas.delete');
    Route::get('/datapetugas/search', [PetugasController::class, 'search'])->name('petugas.search');

    Route::post('/hukuman/store',[ListSiswa::class, 'store'])->name('hukuman.store');
    Route::get('/hukuman/create',[ListSiswa::class, 'create'])->name('hukuman.create');
    Route::get('/hukuman/edit{id}',[ListSiswa::class, 'edit'])->name('hukuman.edit');
    Route::put('/hukuman/update/{id}',[ListSiswa::class, 'update'])->name('hukuman.update');
    Route::delete('/hukuman/{id}', [ListSiswa::class, 'destroy'])->name('hukuman.destroy');
   
    Route::get('/hukuman/search', [ListSiswa::class, 'search'])->name('hukuman.search');
});

Route::middleware(['auth', 'userAkses:siswa'])->group(function () {
    Route::get('/listpelanggaran/siswa',[ListSiswa::class, 'listsiswa'])->name('listsiswa');
    
});

Route::get('/informasi', function(){
    return view ('informasi.informasi', [
        'title' => 'informasi'
    ]);
});
