<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Laporan Data Poin Pelanggaran Siswa</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
            }
    
            /* Kop Surat */
            .kop-surat {
                text-align: center;
                border-bottom: 2px solid black;
                padding-bottom: 10px;
                margin-bottom: 20px;
                position: relative;
            }
    
            .kop-surat img {
                width: 70px; /* Adjust size if necessary */
                height: auto;
                position: absolute;
                top: -10px;
                left: 20px; /* Adjust for left alignment */
            }
    
            .school-info {
                text-align: center;
            }
    
            .school-info h2 {
                margin: 0;
                font-size: 18px;
                text-transform: uppercase;
            }
    
            .school-info p {
                margin: 2px 0;
                font-size: 12px;
            }
    
            /* Title Section */
            h1 {
                text-align: center;
                font-size: 18px;
                margin-top: 10px;
                margin-bottom: 20px;
                text-transform: uppercase;
            }
            h5 {
                text-align: center;
                font-size: 10px;
                margin-top: 5px;
                margin-bottom: 13px;
                text-transform: uppercase;
            }
    
            /* Table */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
    
            table, th, td {
                border: 1px solid black;
            }
    
            th, td {
                padding: 8px;
                text-align: center;
                font-size: 12px;
            }
    
            th {
                background-color: #f2f2f2;
            }
    
            /* Footer styling */
            /* .footer {
                position: fixed;
                bottom: 10px;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 12px;
            }
                
            .page-number:before {
                content: "Page " counter(page);
            } */

            .footer {
                position: fixed;
                bottom: 10px;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 12px;
            }

            /* Additional container for page number */
            .footer-container {
                position: relative;
            }

            .page-number {
                position: absolute;
                right: 0;
            }

            .page-number:before {
                content: "Page " counter(page);
            }
        </style>
    </head>
    <body>
        <!-- Kop Surat Section -->
        <div class="kop-surat">
            <img src="{{ public_path('assets/img/smk1.png') }}" alt="School Logo">
            <div class="school-info">
                <h2>SMK Negeri 1 Kawali</h2>
                <p>Jl.Talagasari, No.35 Kawalimukti, Kawali Kabupaten Ciamis Jawa Barat 46252</p>
                <p>Telp: (0265) 791727 | Email: smkn1kawali@gmail.com</p>
            </div>
        </div>
    
        <!-- Title Section -->
        <h5>
            Data Siswa 
            Kelas {{ $kelas == 'all' ? '(Semua Kelas)' : strtoupper($kelas) }},
            Jurusan {{ $jurusan == 'all' ? '(Semua Jurusan)' : strtoupper($jurusan) }} 
        </h5>
    
        <!-- Table Section -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Jenis Kelamin</th>
                    <th>Poin Pelanggaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentItem as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->kelas }}</td>
                    <td>{{ $student->jurusan }}</td>
                    <td>{{ $student->jk }}</td>
                    <td>{{ $student->point }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
        <!-- Optional Footer Section -->
        <div class="footer">
            <div class="footer-container">
                <p>Generated by Sistem Monitoring Pelanggaran Siswa - {{ date('Y') }}</p>
                <div class="page-number"></div>
            </div>
        </div>
    </body>
    
</html>

