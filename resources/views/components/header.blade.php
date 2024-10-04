<div class="content-header">
  <style>
      .garis {
          height: 3px;
          @if($slot == 'Beranda')
              width: 110px;
          @elseif($slot == 'List Pelanggaran Siswa')
              width: 300px;
          @elseif($slot == 'Kategori Pelanggaran')
              width: 280px;
          @elseif($slot == 'Data Siswa')
              width: 145px;
          @elseif($slot == 'Data Guru')
              width: 135px;
          @elseif($slot == 'Data Petugas')
              width: 175px;
          @elseif($slot == 'Laporan')
              width: 110px;
          @elseif($slot == 'Review Laporan')
              width: 208px;
          @elseif($slot == 'Tambah Akun')
              width: 182px;
          @endif
      }
  </style>
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark ml-0 mb-3">{{ $slot }}</h1>
        <div class="garis rounded-pill my-3 mt-n2" style="background-color: #4D869C"></div>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active mr-2">{{ $slot }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>
