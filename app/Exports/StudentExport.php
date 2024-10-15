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
    protected $kelas;

    public function __construct($jurusan, $kelas)
    {
        $this->jurusan = $jurusan;
        $this->kelas = $kelas;
    }

    public function collection()
    {
        // Query to fetch students based on jurusan and kelas
        $studentQuery = Student::query();

        if ($this->jurusan != 'all') {
            $studentQuery->where('jurusan', $this->jurusan);
        }

        if ($this->kelas != 'all') {
            $studentQuery->where('kelas', $this->kelas);
        }

        return $studentQuery->get();
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
        return 'A5'; // Table starts at A5 after the header
    }

    public function styles(Worksheet $sheet)
    {
        // Merge cells for the institution name
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'SMK Negeri 1 Kawali');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Merge cells for the address
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Jl.Talagasari, No.35 Kawalimukti, Kawali, Kabupaten Ciamis, Jawa Barat, 46252');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Merge cells for the report title
        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', 
            ($this->jurusan == 'all' ? 'Data Siswa Semua Jurusan' : 'Data Siswa Jurusan ' . $this->jurusan) . 
            ' - ' . 
            ($this->kelas == 'all' ? 'Semua Kelas' : 'Kelas ' . $this->kelas)
        );
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Style for the headings
        $sheet->getStyle('A5:G5')->getFont()->setBold(true);
        $sheet->getStyle('A5:G5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set auto width for columns
        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }
}