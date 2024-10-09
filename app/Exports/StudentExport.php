<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class StudentExport implements FromCollection , WithMapping, WithHeadings, WithCustomStartCell ,WithStyles
{
    use Exportable;

    protected $jurusan;

    public function __construct($jurusan)
    {
        $this->jurusan = $jurusan;
    }

    public function collection()
    {
        return $this->jurusan == 'all' ? Student::all() : Student::where('jurusan', $this->jurusan)->get();
    }

    public function map($studentItem): array
    {
        return [
            $studentItem->id,
            $studentItem->nis,
            $studentItem->nama,
            $studentItem->kelas,
            $studentItem->jurusan,
            $studentItem->jk,
            $studentItem->point,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'NIS',
            'Nama',
            'Kelas',
            'Jurusan',
            'Jenis Kelamin',
            'Poin Pelanggaran',
        ];
    }

    public function startCell(): string
    {
        return 'A5'; // Tabel data dimulai dari cell A5 setelah kop surat
    }

    public function styles(Worksheet $sheet)
    {
        // Merge cells for the kop surat
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'SMK Negeri 1 Kawali'); // Nama institusi
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Alamat institusi
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Jl.Talagasari, No.35 Kawalimukti, Kawali, Kabupaten Ciamis, Jawa Barat, 46252'); // Alamat institusi
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Merger cell untuk keterangan
        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', $this->jurusan == 'all' ? 'Data Siswa Semua Jurusan' : 'Data Siswa Jurusan ' . $this->jurusan);
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Style untuk heading tabel
        $sheet->getStyle('A5:G5')->getFont()->setBold(true); // Row 5 berisi heading
        $sheet->getStyle('A5:G5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set lebar kolom otomatis
        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }
}

// {
//     use Exportable;
//     protected $jurusan;

//     public function __construct($jurusan)
//     {
//         $this->jurusan = $jurusan;
//     }

//     public function collection()
//     {
//     //    return Student::query();
//         if ($this->jurusan == 'all') {
//             return Student::all(); // Export all students
//         } else {
//             return Student::where('jurusan', $this->jurusan)->get(); // Export filtered students
//         }
//     }

//     public function map($studentItem): array
//     {
//         return [
//             $studentItem->id,
//             $studentItem->nis,
//             $studentItem->nama,
//             $studentItem->kelas,
//             $studentItem->jurusan,
//             $studentItem->jk,
//             $studentItem->point,
//         ];
//     }
//     public function headings(): array
//     {
//         return [
//             'No',
//             'NIS',
//             'Nama',
//             'Kelas',
//             'Jurusan',
//             'Jenis Kelamin',
//             'Poin Pelanggaran',
            
//         ];
//     }
//     public function startCell(): string
//     {
//         return 'A3'; // Tabel data dimulai dari cell A3
//     }

//     // Menambahkan judul atau keterangan di bagian atas file export
//     // public function title(): array
//     // {
//     //     if ($this->jurusan == 'all') {
//     //         return ['Data siswa semua jurusan'];
//     //     } else {
//     //         return ['Data siswa jurusan ' . $this->jurusan];
//     //     }
//     // }
//     public function styles(Worksheet $sheet)
//     {
//         // Merge cells for the title
//         $sheet->mergeCells('A1:G1');
        
//         // Add title text
//         $sheet->setCellValue('A1', $this->jurusan == 'all' ? 'Data Siswa Semua Jurusan' : 'Data Siswa Jurusan ' . $this->jurusan);
        
//         // Style for the title
//         $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
//         $sheet->getStyle('A1')->getFont()->setBold(true);

//         return [
//             // Add bold headings
//             3 => ['font' => ['bold' => true]], // Row 4 contains the headings
//         ];
//     }
// }
