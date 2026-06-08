<?php

namespace App\Exports;

use App\Models\SyaratUjian;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdmRecapMultiSheetExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        // Ambil semua tahun dan semester dari ketiga tabel
        $tahunSemesterList = SyaratUjian::with(['kolokiummhs.semester', 'seminarmhs.semester', 'komprehensifmhs.semester'])
            ->get()
            ->flatMap(function ($item) {
                $entries = [];

                if ($item->kolokiummhs?->semester?->semester && $item->kolokiummhs->tahun_ajaran) {
                    $entries[] = [
                        'semester' => $item->kolokiummhs->semester->semester,
                        'tahun_ajaran' => $item->kolokiummhs->tahun_ajaran,
                    ];
                }

                if ($item->seminarmhs?->semester?->semester && $item->seminarmhs->tahun_ajaran) {
                    $entries[] = [
                        'semester' => $item->seminarmhs->semester->semester,
                        'tahun_ajaran' => $item->seminarmhs->tahun_ajaran,
                    ];
                }

                if ($item->komprehensifmhs?->semester?->semester && $item->komprehensifmhs->tahun_ajaran) {
                    $entries[] = [
                        'semester' => $item->komprehensifmhs->semester->semester,
                        'tahun_ajaran' => $item->komprehensifmhs->tahun_ajaran,
                    ];
                }

                return $entries;
            });

        // Hapus data duplikat dan kosong
        $tahunSemesterList = $tahunSemesterList
            ->filter(fn ($item) => ! empty($item['tahun_ajaran']))
            ->unique(function ($item) {
                return $item['semester'].'_'.$item['tahun_ajaran'];
            });

        // Buat sheet hanya untuk kombinasi semester + tahun ajaran yang valid
        foreach ($tahunSemesterList as $item) {
            $sheets[] = new AdmRecapDataExport($item['semester'], $item['tahun_ajaran']);
        }

        // Jika tidak ada data sama sekali, buat 1 sheet default
        if (empty($sheets)) {
            $sheets[] = new AdmRecapDataExport('Ganjil', date('Y').'/'.(date('Y') + 1));
        }

        return $sheets;
    }
}
