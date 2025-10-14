<?php

namespace App\Http\Controllers;

use App\Models\AdmRecapData;
use App\Models\KolokiumMhs;
use App\Models\KomprehensifMhs;
use App\Models\SeminarMhs;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdmRecapDataExport;
use App\Exports\AdmRecapMultiSheetExport;

class AdmRecapDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kolokium = KolokiumMhs::all()->keyBy('nim');
        $seminar = SeminarMhs::all()->keyBy('nim');
        $kompre = KomprehensifMhs::all()->keyBy('nim');

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
                $semester = $kolokiumData->semester->semester ?? '-';
                $tanggal_kolokium = $kolokiumData->tanggal ?? '-';
                $tanggal_seminar = $seminarData->tanggal ?? '-';
                $tanggal_komprehensif = $kompreData->tanggal ?? '-';

                // Ambil SKL dan status genap jika ada di kompre
                $ket_sem_ganjil = $kompreData ? ($kompreData->skl ? 'SKL sudah' : '-') : '-';
                $genap_2024_2025 = $kompreData->status ?? '-';

                $recap[] = [
                    'nama' => $identitas->nama ?? '-',
                    'nim' => $nim,
                    'pembimbing1' => $pembimbing1,
                    'pembimbing2' => $pembimbing2,
                    'semester_genap' => $semester,
                    'tanggal_kolokium' => $tanggal_kolokium,
                    'tanggal_seminar' => $tanggal_seminar,
                    'tanggal_ujian' => $tanggal_komprehensif,
                    'ket_sem_ganjil' => $ket_sem_ganjil,
                    'genap_2024_2025' => $genap_2024_2025,
                    'skl' => $kompreData->skl ?? null,  
                    'status' => $kompreData->status ?? null,
                ];
            }

        return view('recapdata.index', compact('recap'));
    }

    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function updateSKL($nim){
        $kompre = KomprehensifMhs::where('nim', $nim)->first();
        $kompre->update(['skl' => 'SKL Sudah', 'status' => 'Lulus']);

        return redirect()->back()->with('success', 'Status SKL diperbarui.');
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
