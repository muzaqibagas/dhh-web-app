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

        $jadwal = SyaratUjian::with([
            'mahasiswa',
            'kolokiummhs',
            'seminarmhs',
            'komprehensifmhs',
            'penilaian', // semua penilaian untuk syarat ujian ini
        ])
            ->where('status', 'disetujui')
            ->when($jenis, function ($q) use ($jenis) {
                $q->where('jenis_ujian', $jenis);
            })
            ->get()

            // 🔥 MAP DATA
            ->map(function ($item) {

                $relasi = $item->jenis_ujian === 'kolokium' ? $item->kolokiummhs :
                        ($item->jenis_ujian === 'seminar' ? $item->seminarmhs :
                        $item->komprehensifmhs);

                if (! $relasi) {
                    return null;
                }

                // tanggal ujian
                $item->tanggal_ujian = $relasi->tanggal ?? null;

                // label jenis
                $item->jenis_ujian_label = match ($item->jenis_ujian) {
                    'kolokium' => 'Kolokium',
                    'seminar' => 'Seminar Hasil',
                    'komprehensif' => 'Komprehensif',
                    default => '-'
                };

                // 🔥 ambil semua penilaian untuk syarat ujian ini
                $item->all_penilaian = $item->penilaian ?? collect();

                // hitung rata-rata nilai akhir
                $nilai_akhir_list = $item->all_penilaian->pluck('nilai_akhir')->filter()->values();
                $item->rata_rata_nilai = $nilai_akhir_list->isNotEmpty() ? round($nilai_akhir_list->avg(), 2) : null;

                return $item;
            })

            ->filter()
            ->sortByDesc('tanggal_ujian');

        return view('penilaianadm.index', compact('jadwal', 'jenis'));
    }

    /**
     * Show the specified resource.
     */
    public function show($id_syarat_ujian)
    {
        // 🔥 Ambil data syarat ujian
        $syarat = SyaratUjian::with([
            'mahasiswa',
            'kolokiummhs',
            'seminarmhs',
            'komprehensifmhs',
        ])->findOrFail($id_syarat_ujian);

        $jenis = $syarat->jenis_ujian;

        // 🔥 Ambil relasi berdasarkan jenis ujian
        $relasi = match ($jenis) {
            'kolokium' => $syarat->kolokiummhs,
            'seminar' => $syarat->seminarmhs,
            'komprehensif' => $syarat->komprehensifmhs,
            default => null
        };

        if (! $relasi) {
            abort(404);
        }

        // 🔥 Ambil judul TA
        $judul = match ($jenis) {
            'kolokium' => $relasi->judul_kolokium ?? '-',
            'seminar' => $relasi->judul_seminar ?? '-',
            'komprehensif' => $relasi->judul_komprehensif ?? '-',
            default => '-'
        };

        // 🔥 Ambil semua penilaian
        $penilaians = Penilaian::where('id_syarat_ujian', $syarat->id)
            ->with([
                'rubrik',
                'moderator',
                'penguji',
                'pembimbing1',
                'pembimbing2',
            ])
            ->orderBy('id')
            ->get();

        // 🔥 Group berdasarkan dosen penilai
        $penilaianPerDosen = $penilaians->groupBy(function ($item) {

            if ($item->id_moderator) {
                return 'moderator_'.$item->id_moderator;
            }

            if ($item->id_penguji) {
                return 'penguji_'.$item->id_penguji;
            }

            if ($item->id_pembimbing1) {
                return 'pembimbing1_'.$item->id_pembimbing1;
            }

            if ($item->id_pembimbing2) {
                return 'pembimbing2_'.$item->id_pembimbing2;
            }

            return 'unknown';
        });

        // 🔥 Rekap nilai dosen
        $nilaiPerDosen = $penilaianPerDosen->map(function ($items) {

            $first = $items->first();

            if ($first->id_moderator) {
                $namaDosen = $first->moderator->nama ?? '-';
                $role = 'Moderator';
            } elseif ($first->id_penguji) {
                $namaDosen = $first->penguji->nama ?? '-';
                $role = 'Penguji';
            } elseif ($first->id_pembimbing1) {
                $namaDosen = $first->pembimbing1->nama ?? '-';
                $role = 'Pembimbing 1';
            } elseif ($first->id_pembimbing2) {
                $namaDosen = $first->pembimbing2->nama ?? '-';
                $role = 'Pembimbing 2';
            } else {
                $namaDosen = '-';
                $role = '-';
            }

            return [
                'nama_dosen' => $namaDosen,
                'role' => $role,
                'nilai_akhir' => $items->first()->nilai_akhir ?? null,
            ];
        })->values();

        // 🔥 Total nilai
        $jumlahPenilai = $nilaiPerDosen->count();

        $totalNilai = $nilaiPerDosen->sum(function ($item) {
            return $item['nilai_akhir'] ?? 0;
        });

        $rataRata = $jumlahPenilai > 0
            ? $totalNilai / $jumlahPenilai
            : null;

        return view('penilaianadm.show', [
            'data' => $syarat,
            'jenis' => $jenis,
            'judul' => $judul,
            'penilaianPerDosen' => $penilaianPerDosen,
            'nilaiPerDosen' => $nilaiPerDosen,
            'jumlahPenilai' => $jumlahPenilai,
            'totalNilai' => $totalNilai,
            'rataRata' => $rataRata,
        ]);
    }
}
