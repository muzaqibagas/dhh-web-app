<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Rubrik;
use App\Models\SyaratUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Auth::guard('staff')->user();

        $jadwal = SyaratUjian::with([
            'mahasiswa',
            'kolokiummhs',
            'seminarmhs',
            'komprehensifmhs',
        ])
            ->where('status', 'disetujui')
            ->get()

            // 🔥 FILTER: hanya yg terkait dosen
            ->filter(function ($item) use ($dosen) {

                $relasi = $item->jenis_ujian === 'kolokium' ? $item->kolokiummhs :
                        ($item->jenis_ujian === 'seminar' ? $item->seminarmhs :
                        $item->komprehensifmhs);

                if (! $relasi) {
                    return false;
                }

                return
                    $item->id_moderator == $dosen->id ||
                    ($relasi->id_pembimbing1 ?? null) == $dosen->id ||
                    ($relasi->id_pembimbing2 ?? null) == $dosen->id ||
                    ($item->id_penguji ?? null) == $dosen->id;
            })

            // 🔥 MAP DATA
            ->map(function ($item) use ($dosen) {

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

                // 🔥 tentukan peran dosen
                $peran = [];

                if ($item->id_moderator == $dosen->id) {
                    $peran[] = $item->jenis_ujian === 'komprehensif'
                        ? 'Ketua Sidang'
                        : 'Moderator';
                }

                if (($relasi->id_pembimbing1 ?? null) == $dosen->id ||
                    ($relasi->id_pembimbing2 ?? null) == $dosen->id) {
                    $peran[] = 'Pembimbing';
                }

                if (($item->id_penguji ?? null) == $dosen->id) {
                    $peran[] = 'Penguji';
                }

                // 🔥 ambil penilaian dari tabel baru
                $item->current_penilaian = Penilaian::where('id_syarat_ujian', $item->id)
                    ->where(function ($q) use ($dosen) {
                        $q->where('id_moderator', $dosen->id)
                            ->orWhere('id_pembimbing1', $dosen->id)
                            ->orWhere('id_pembimbing2', $dosen->id)
                            ->orWhere('id_penguji', $dosen->id);
                    })
                    ->first();

                $item->peran_dosen = implode(', ', $peran);

                return $item;
            })

            ->filter()
            ->sortByDesc('tanggal_ujian');

        return view('penilaian.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jenis = strtolower(trim($request->jenis ?? ''));
        $id = $request->id;

        if (! $jenis || ! $id) {
            abort(404, 'Parameter tidak lengkap');
        }

        $syarat = SyaratUjian::with([
            'mahasiswa',
            'kolokiummhs',
            'seminarmhs',
            'komprehensifmhs',
        ])->findOrFail($id);

        // ambil relasi sesuai jenis
        if ($jenis === 'kolokium') {
            $relasi = $syarat->kolokiummhs;
            $judul = $relasi->judul_kolokium ?? '-';
        } elseif ($jenis === 'seminar') {
            $relasi = $syarat->seminarmhs;
            $judul = $relasi->judul_seminar ?? '-';
        } elseif ($jenis === 'komprehensif') {
            $relasi = $syarat->komprehensifmhs;
            $judul = $relasi->judul_tugasakhir ?? '-';
        } else {
            abort(404);
        }

        if (! $relasi) {
            abort(404, 'Data sidang tidak ditemukan');
        }

        $rubriks = Rubrik::where('jenis_sidang', $jenis)->get();

        return view('penilaian.create', [
            'data' => $syarat,
            'relasi' => $relasi,
            'jenis' => $jenis,
            'judul' => $judul,
            'rubriks' => $rubriks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nilai' => 'required|array',
        ]);

        $id = $request->id; // ini ID syaratujian
        $jenis = strtolower($request->jenis);
        $dosenId = Auth::guard('staff')->id();

        $penilaianIds = [];
        $totalScore = 0;

        $syarat = SyaratUjian::with([
            'kolokiummhs',
            'seminarmhs',
            'komprehensifmhs',
        ])->findOrFail($id);

        if ($jenis === 'kolokium') {
            $sidang = $syarat->kolokiummhs;
        } elseif ($jenis === 'seminar') {
            $sidang = $syarat->seminarmhs;
        } elseif ($jenis === 'komprehensif') {
            $sidang = $syarat->komprehensifmhs;
        } else {
            abort(404, 'Jenis ujian tidak valid');
        }

        if (! $sidang) {
            abort(404, 'Data sidang tidak ditemukan');
        }

        $roleField = null;

        if ($syarat->id_moderator == $dosenId) {
            $roleField = 'id_moderator';
        } elseif (($sidang->id_pembimbing1 ?? null) == $dosenId) {
            $roleField = 'id_pembimbing1';
        } elseif (($sidang->id_pembimbing2 ?? null) == $dosenId) {
            $roleField = 'id_pembimbing2';
        } elseif (($syarat->id_penguji ?? null) == $dosenId) {
            $roleField = 'id_penguji';
        } else {
            abort(403, 'Anda tidak punya akses sebagai penilai');
        }

        foreach ($request->nilai as $rubrikId => $nilai) {

            $rubrik = Rubrik::findOrFail($rubrikId);
            $bobot = $rubrik->bobot;

            $score = ($nilai / 4) * $bobot;

            $dataInsert = [
                'id_syarat_ujian' => $syarat->id,
                $roleField => $dosenId,
                'id_rubrik' => $rubrikId,
                'nilai' => $nilai,
                'score' => $score,
                'catatan' => $request->catatan,
            ];

            $penilaian = Penilaian::create($dataInsert);

            $penilaianIds[] = $penilaian->id;
            $totalScore += $score;
        }

        Penilaian::whereIn('id', $penilaianIds)
            ->update([
                'nilai_akhir' => $totalScore,
            ]);

        return redirect()
            ->route('penilaian.show', $penilaianIds[0])
            ->with('success', 'Penilaian berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penilaian $penilaian)
    {
        $dosenId = Auth::guard('staff')->id();

        // 🔥 ambil syarat ujian utama
        $syarat = SyaratUjian::with([
            'mahasiswa',
            'kolokiummhs',
            'seminarmhs',
            'komprehensifmhs',
        ])->findOrFail($penilaian->id_syarat_ujian);

        $jenis = $syarat->jenis_ujian;

        // 🔥 ambil relasi sesuai jenis
        $relasi = match ($jenis) {
            'kolokium' => $syarat->kolokiummhs,
            'seminar' => $syarat->seminarmhs,
            'komprehensif' => $syarat->komprehensifmhs,
            default => null
        };

        if (! $relasi) {
            abort(404);
        }

        // 🔥 ambil judul
        $judul = match ($jenis) {
            'kolokium' => $relasi->judul_kolokium ?? '-',
            'seminar' => $relasi->judul_seminar ?? '-',
            'komprehensif' => $relasi->judul_tugasakhir ?? '-',
            default => '-'
        };

        // 🔥 penilaian dosen login
        $penilaians = Penilaian::where('id_syarat_ujian', $syarat->id)
            ->where(function ($q) use ($dosenId) {
                $q->where('id_moderator', $dosenId)
                    ->orWhere('id_penguji', $dosenId)
                    ->orWhere('id_pembimbing1', $dosenId)
                    ->orWhere('id_pembimbing2', $dosenId);
            })
            ->with('rubrik')
            ->get();

        // 🔥 semua penilaian (untuk rekap)
        $allPenilaians = Penilaian::where('id_syarat_ujian', $syarat->id)
            ->whereNotNull('nilai_akhir')
            ->get();

        // 🔥 GROUP NILAI PER DOSEN
        $nilaiPerDosen = $allPenilaians
            ->groupBy(function ($item) {
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
            })
            ->map(function ($items) {

                $item = $items->first();

                if ($item->id_moderator) {
                    $role = 'Moderator';
                    $dosen = $item->moderator;
                } elseif ($item->id_penguji) {
                    $role = 'Penguji';
                    $dosen = $item->penguji;
                } elseif ($item->id_pembimbing1) {
                    $role = 'Pembimbing 1';
                    $dosen = $item->pembimbing1;
                } elseif ($item->id_pembimbing2) {
                    $role = 'Pembimbing 2';
                    $dosen = $item->pembimbing2;
                } else {
                    $role = '-';
                    $dosen = null;
                }

                return [
                    'nama_dosen' => $dosen->nama ?? '-',
                    'role' => $role,
                    'nilai_akhir' => $items->avg('nilai_akhir'),
                ];
            })
            ->values();

        // 🔥 HITUNG TOTAL
        $jumlahPenilai = $nilaiPerDosen->count();
        $totalNilai = $nilaiPerDosen->sum('nilai_akhir');
        $rataRata = $jumlahPenilai > 0 ? $totalNilai / $jumlahPenilai : null;

        return view('penilaian.show', [
            'data' => $syarat,
            'jenis' => $jenis,
            'judul' => $judul,
            'penilaians' => $penilaians,
            'nilaiPerDosen' => $nilaiPerDosen,
            'jumlahPenilai' => $jumlahPenilai,
            'totalNilai' => $totalNilai,
            'rataRata' => $rataRata,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penilaian $penilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }
}
