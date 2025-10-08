<?php

namespace App\Http\Controllers;

use App\Models\AdmRecapData;
use App\Models\KolokiumMhs;
use App\Models\KomprehensifMhs;
use App\Models\SeminarMhs;
use Illuminate\Http\Request;

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
            $identitas = $kolokium[$nim] ?? $seminar[$nim] ?? $kompre[$nim] ?? null;

            // Cek dan ambil nama pembimbing jika field JSON
            $pembimbing1 = '-';
            if ($identitas && !empty($identitas->pembimbing1)) {
                $pembimbing1 = $identitas->pembimbing1;
                if ($this->isJson($pembimbing1)) {
                    $json = json_decode($pembimbing1, true);
                    $pembimbing1 = $json['nama'] ?? '-';
                }
            }            

            $pembimbing2 = '-';
            if ($identitas && !empty($identitas->pembimbing2)) {
                $pembimbing2 = $identitas->pembimbing2;
                if ($this->isJson($pembimbing2)) {
                    $json = json_decode($pembimbing2, true);
                    $pembimbing2 = $json['nama'] ?? '-';
                }
            }

            $semester = $kolokium[$nim]->semester->semester ?? '-';
            $tanggal_kolokium = $kolokium[$nim]->tanggal ?? '-';
            $tanggal_seminar = $seminar[$nim]->tanggal ?? '-';
            $tanggal_komprehensif = $kompre[$nim]->tanggal ?? '-';

            $recap[] = [
                'nama' => $identitas->nama ?? '-',
                'nim' => $nim,
                'pembimbing1' => $pembimbing1,
                'pembimbing2' => $pembimbing2,
                'semester_genap' => $semester,
                'tanggal_kolokium' => $tanggal_kolokium,
                'tanggal_seminar' => $tanggal_seminar,
                'tanggal_ujian' => $tanggal_komprehensif,
                'ket_sem_ganjil' => $kompre[$nim]->ket_sem_ganjil ?? '-',
                'genap_2024_2025' => $kompre[$nim]->genap_2024_2025 ?? '-',
            ];
        }

        return view('recapdata.index', compact('recap'));
    }

    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
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
