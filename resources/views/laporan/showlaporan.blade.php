<div class="container">
    <table class="card-body">
        <div>
            <tr>
                <td>Nama Pelapor </td>
                <td> : </td>
                <td>{{ $report->pelapor->name ?? 'tidak diketahui' }}</td>
            </tr>
            <tr>
                <td>Nama Pelanggaran</td>
                <td> : </td>
                <td>{{ $report->pelanggaran}}</td>
            </tr>
            <tr>
                <td>Point yang Diterima </td>
                <td> : </td>
                <td>{{ $report->point}}</td>
            </tr>
            <tr>
                <td>Tanggal </td>
                <td> : </td>
                <td>{{ $report->tanggal}}</td>
            </tr>
            <tr>
                <td>Nama Siswa </td>
                <td> : </td>
                <td>{{ $report->nama}}</td>
            </tr>
            <tr>
                <td>Nis </td>
                <td> : </td>
                <td>{{ $report->nis}}</td>
            </tr>
            <tr>
                <td>kelas </td>
                <td> : </td>
                <td>{{ $report->siswa->kelas}}</td>
            </tr>
            <tr>
                <td>Jurusan </td>
                <td> : </td>
                <td>{{ $report->siswa->jurusan}}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin </td>
                <td> : </td>
                <td>{{ $report->siswa->jk}}</td>
            </tr>

            <tr>
                <td>Total Point Yang Diperoleh </td>
                <td> : </td>
                <td>{{ $report->siswa->point}}</td>
            </tr>
          
        </div>
    </table>

</div>
