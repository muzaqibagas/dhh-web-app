<?php

namespace App\Exports;

use App\Models\KolokiumMhs;
use App\Models\SeminarMhs;
use App\Models\KomprehensifMhs;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdmRecapMultiSheetExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        // Ambil semua tahun dan semester dari ketiga tabel
        $tahunSemesterList = collect();

        $tahunSemesterList = $tahunSemesterList
            ->merge(KolokiumMhs::with('semester')->get()->map(function ($item) {
                return [
                    'semester' => $item->semester->semester ?? '-',
                    'tahun_ajaran' => $item->tahun_ajaran ?? null,
                ];
            }))
            ->merge(SeminarMhs::with('semester')->get()->map(function ($item) {
                return [
                    'semester' => $item->semester->semester ?? '-',
                    'tahun_ajaran' => $item->tahun_ajaran ?? null,
                ];
            }))
            ->merge(KomprehensifMhs::with('semester')->get()->map(function ($item) {
                return [
                    'semester' => $item->semester->semester ?? '-',
                    'tahun_ajaran' => $item->tahun_ajaran ?? null,
                ];
            }));

        // Hapus data duplikat dan kosong
        $tahunSemesterList = $tahunSemesterList
            ->filter(fn($item) => !empty($item['tahun_ajaran']))
            ->unique(function ($item) {
                return $item['semester'] . '_' . $item['tahun_ajaran'];
            });

        // Buat sheet hanya untuk kombinasi semester + tahun ajaran yang valid
        foreach ($tahunSemesterList as $item) {
            $sheets[] = new AdmRecapDataExport($item['semester'], $item['tahun_ajaran']);
        }

        // Jika tidak ada data sama sekali, buat 1 sheet default
        if (empty($sheets)) {
            $sheets[] = new AdmRecapDataExport('Ganjil', date('Y') . '/' . (date('Y') + 1));
        }

        return $sheets;
    }
}
