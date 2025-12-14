<?php

namespace App\Exports;

use App\Models\Kolokiummhs;
use App\Models\Seminarmhs;
use App\Models\Komprehensifmhs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class AdmRecapDataExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithStyles
{    
    public function collection()
    {
        $kolokium = KolokiumMhs::all()->keyBy('nim');
        $seminar = SeminarMhs::all()->keyBy('nim');
        $kompre = KomprehensifMhs::all()->keyBy('nim');

        $nims = $kolokium->keys()->merge($seminar->keys())->merge($kompre->keys())->unique();
        $recap = collect();

        foreach ($nims as $nim) {
            $kolokiumData = $kolokium[$nim] ?? null;
            $seminarData = $seminar[$nim] ?? null;
            $kompreData = $kompre[$nim] ?? null;
            $identitas = $kolokiumData ?? $seminarData ?? $kompreData ?? null;

            if (!$identitas) continue;
            $pembimbing1 = $this->decodePembimbing($identitas->pembimbing1 ?? '-');
            $pembimbing2 = $this->decodePembimbing($identitas->pembimbing2 ?? '-');

            $semester = $kolokiumData?->semester->semester ?? '-';            

            $recap->push([
                'Nama' => $identitas?->nama ?? '-',
                'NIM' => $nim,
                'Pembimbing 1' => $pembimbing1,
                'Pembimbing 2' => $pembimbing2,
                'Semester' => $semester,
                'Tanggal Kolokium' => $kolokiumData->tanggal ?? '-',
                'Tanggal Seminar' => $seminarData->tanggal ?? '-',
                'Tanggal Ujian' => $kompreData->tanggal ?? '-',
                'Tanggal SKL' => $kompreData?->tanggal_skl ? Carbon::parse($kompreData->tanggal_skl)->format('Y-m-d') : '-',
                'Tahun Lulus' => $kompreData->status ?? '-',
            ]);
        }

        return $recap;
    }

    private function decodePembimbing($value)
    {
        if ($this->isJson($value)) {
            $json = json_decode($value, true);
            return $json['nama'] ?? '-';
        }
        return $value;
    }

    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'Pembimbing 1',
            'Pembimbing 2',
            'Semester',
            'Tanggal Kolokium',
            'Tanggal Seminar',
            'Tanggal Ujian',
            "Tanggal SKL",
            'Tahun Lulus',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                foreach (range('A', 'J') as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setAutoSize(true);
                }

                $cellRange = 'A1:' . $event->sheet->getHighestColumn() . $event->sheet->getHighestRow();
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
