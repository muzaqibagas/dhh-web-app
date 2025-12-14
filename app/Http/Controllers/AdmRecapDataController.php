<?php

namespace App\Http\Controllers;

use App\Models\AdmRecapData;
use App\Models\Kolokiummhs;
use App\Models\Komprehensifmhs;
use App\Models\Seminarmhs;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdmRecapDataExport;
use App\Exports\AdmRecapMultiSheetExport;
use Carbon\Carbon;

class AdmRecapDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kolokium = Kolokiummhs::all()->keyBy('nim');
        $seminar = Seminarmhs::all()->keyBy('nim');
        $kompre = Komprehensifmhs::all()->keyBy('nim');

        $nims = $kolokium->keys()->merge($seminar->keys())->merge($kompre->keys())->unique();

        $recap = [];
            foreach ($nims as $nim) {
                // Ambil data jika ada
                $kolokiumData = $kolokium[$nim] ?? null;
                $seminarData = $seminar[$nim] ?? null;
                $kompreData = $kompre[$nim] ?? null;

                // Ambil identitas prioritas: kolokium > seminar > kompre
                $identitas = $kolokiumData ?? $seminarData ?? $kompreData ?? null;

                // Ambil pembimbing 1
                $pembimbing1 = '-';
                if ($identitas && !empty($identitas->pembimbing1)) {
                    $pembimbing1 = $identitas->pembimbing1;
                    if ($this->isJson($pembimbing1)) {
                        $json = json_decode($pembimbing1, true);
                        $pembimbing1 = $json['nama'] ?? '-';
                    }
                }

                // Ambil pembimbing 2
                $pembimbing2 = '-';
                if ($identitas && !empty($identitas->pembimbing2)) {
                    $pembimbing2 = $identitas->pembimbing2;
                    if ($this->isJson($pembimbing2)) {
                        $json = json_decode($pembimbing2, true);
                        $pembimbing2 = $json['nama'] ?? '-';
                    }
                }

                // Ambil tanggal dan semester dengan pengecekan null                
                $semester = $kolokiumData?->semester?->semester ?? '-';
                $tanggal_kolokium = $kolokiumData->tanggal ?? '-';
                $tanggal_seminar = $seminarData->tanggal ?? '-';
                $tanggal_komprehensif = $kompreData->tanggal ?? '-';
                
                $tanggal_skl = $kompreData?->tanggal_skl ? Carbon::parse($kompreData->tanggal_skl)->format('Y-m-d') : '-';                
                
                $status = $kompreData->status ?? '-';
                if ($kompreData && $kompreData->tanggal_skl) {
                    $bulan = Carbon::parse($kompreData->tanggal_skl)->month;
                    $tahun = Carbon::parse($kompreData->tanggal_skl)->year;

                    // Jika bulan 1–7 → Genap, 8–12 → Ganjil
                    if ($bulan >= 1 && $bulan <= 7) {
                        $status = 'Lulus Semester Genap ' . ($tahun - 1) . '/' . $tahun;
                    } else {
                        $status = 'Lulus Semester Ganjil ' . $tahun . '/' . ($tahun + 1);
                    }
                }

                // Ambil SKL dan status genap jika ada di kompre
                $ket_sem_ganjil = $kompreData ? ($kompreData->skl ? 'SKL sudah' : '-') : '-';
                $genap_2024_2025 = $kompreData->status ?? '-';

                $recap[] = [
                    'nama' => $identitas?->nama ?? '-',                    
                    'nim' => $nim,
                    'pembimbing1' => $pembimbing1,
                    'pembimbing2' => $pembimbing2,
                    'semester_genap' => $semester,
                    'tanggal_kolokium' => $tanggal_kolokium,
                    'tanggal_seminar' => $tanggal_seminar,
                    'tanggal_ujian' => $tanggal_komprehensif,
                    'tanggal_skl' => $tanggal_skl,
                    'skl' => $kompreData->skl ?? '-',
                    'status' => $status,
                ];
            }

        return view('recapdata.index', compact('recap'));
    }

    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function updateSKL($nim)
    {
        $kompre = KomprehensifMhs::where('nim', $nim)->first();

        if ($kompre) {
            $tanggalSKL = Carbon::now();

            // Tentukan semester otomatis
            $bulan = $tanggalSKL->month;
            $tahun = $tanggalSKL->year;
            if ($bulan >= 1 && $bulan <= 7) {
                $status = 'Lulus Semester Genap ' . ($tahun - 1) . '/' . $tahun;
            } else {
                $status = 'Lulus Semester Ganjil ' . $tahun . '/' . ($tahun + 1);
            }

            // Update data kompre
            $kompre->update([
                'skl' => 'SKL Sudah',
                'tanggal_skl' => $tanggalSKL,
                'status' => $status,
            ]);
        }

        return redirect()->back()->with('success', 'SKL berhasil dikonfirmasi dan status diperbarui.');
    }


    public function export()
    {
        $filename = 'rekap_data_' . date('Y_m_d_His') . '.xlsx';
        return Excel::download(new AdmRecapMultiSheetExport, 'rekap-tahunan.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AdmRecapData $admRecapData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdmRecapData $admRecapData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdmRecapData $admRecapData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdmRecapData $admRecapData)
    {
        //
    }
}
