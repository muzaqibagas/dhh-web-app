<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\SyaratUjian;
use Illuminate\Http\Request;

class PenilaianAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jenis = $request->get('jenis'); // filter berdasarkan jenis ujian

        $mahasiswa = SyaratUjian::with([
            'mahasiswa',
            'penilaian'
        ])
        ->where('status', 'disetujui')
        ->get()
        ->groupBy('id_mahasiswa')
        ->map(function ($items) {

            $first = $items->first();

            $data = [
                'id_mahasiswa' => $first->id_mahasiswa,
                'nama' => $first->mahasiswa->nama ?? '-',
                'nim' => $first->mahasiswa->nim ?? '-',
                'kolokium' => null,
                'seminar' => null,
                'komprehensif' => null,
                'has_penilaian' => false,
            ];

            foreach ($items as $item) {

                $nilai = $item->penilaian
                    ->pluck('nilai_akhir')
                    ->filter()
                    ->avg();

                if ($item->penilaian->isNotEmpty()) {
                    $data['has_penilaian'] = true;
                }

                if ($item->jenis_ujian == 'kolokium') {
                    $data['kolokium'] = $nilai;
                }

                if ($item->jenis_ujian == 'seminar') {
                    $data['seminar'] = $nilai;
                }

                if ($item->jenis_ujian == 'komprehensif') {
                    $data['komprehensif'] = $nilai;
                }
            }

            return $data;
        });

        return view('penilaianadm.index', compact('mahasiswa', 'jenis'));
    }

    /**
     * Show the specified resource.
     */
    public function show($id_mahasiswa)
    {
        $ujians = SyaratUjian::with([
            'penilaian.rubrik',
            'penilaian.moderator',
            'penilaian.penguji',
            'penilaian.pembimbing1',
            'penilaian.pembimbing2',
            'mahasiswa'
        ])
        ->where('id_mahasiswa', $id_mahasiswa)
        ->get();

        return view('penilaianadm.show', compact('ujians'));
    }
}
