<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Rubrik;
use App\Models\SyaratUjian;
use App\Models\jadwalTA;
use App\Models\Kolokiummhs;
use App\Models\Komprehensifmhs;
use App\Models\Seminarmhs;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dosenId = Auth::guard('staff')->id();
        $search = $request->input('search', '');

        // ============================================
        // KOLOKIUM - Query untuk penilaian kolokium
        // ============================================
        $kolokiumQuery = SyaratUjian::where('jenis_ujian', 'kolokium')
            ->with(['mahasiswa', 'kolokiummhs', 'penilaian'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_moderator', $dosenId)
                    ->orWhere(function ($subQ) use ($dosenId) {
                        $subQ->whereHas('kolokiummhs', function ($builder) use ($dosenId) {
                            $builder->where('id_pembimbing1', $dosenId)
                                ->orWhere('id_pembimbing2', $dosenId);                                
                        });
                    });
            });

        // ============================================
        // SEMINAR - Query untuk penilaian seminar
        // ============================================
        $seminarQuery = SyaratUjian::where('jenis_ujian', 'seminar')
            ->with(['mahasiswa', 'seminarmhs', 'penilaian'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_moderator', $dosenId)
                    ->orWhere(function ($subQ) use ($dosenId) {
                        $subQ->whereHas('seminarmhs', function ($builder) use ($dosenId) {
                            $builder->where('id_pembimbing1', $dosenId)
                                ->orWhere('id_pembimbing2', $dosenId);
                        });
                    });
            });

        // ============================================
        // KOMPREHENSIF - Query untuk penilaian komprehensif
        // ============================================
        $komprehensifQuery = SyaratUjian::where('jenis_ujian', 'komprehensif')
            ->with(['mahasiswa', 'komprehensifmhs', 'penilaian'])
            ->where(function ($q) use ($dosenId) {
                $q->where('id_moderator', $dosenId)
                    ->orWhere('id_penguji', $dosenId)
                    ->orWhere(function ($subQ) use ($dosenId) {
                        $subQ->whereHas('komprehensifmhs', function ($builder) use ($dosenId) {
                            $builder->where('id_pembimbing1', $dosenId)
                                ->orWhere('id_pembimbing2', $dosenId);
                        });
                    });
            });

        // ============================================
        // COMBINE & SEARCH
        // ============================================
        if ($search) {
            $search = trim($search);
            $kolokiumQuery->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
            $seminarQuery->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
            $komprehensifQuery->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        // Get data dari ketiga query
        $kolokiumData = $kolokiumQuery->get();
        $seminarData = $seminarQuery->get();
        $komprehensifData = $komprehensifQuery->get();

        // ============================================
        // FORMAT DATA UNTUK DISPLAY
        // ============================================
        $jadwal = collect();

        // Format Kolokium
        foreach ($kolokiumData as $syarat) {
            $peranDosen = $this->getPeranDosen($syarat, $dosenId, 'kolokium');
            $penilaianDosen = $this->getPenilaianDosen($syarat, $dosenId);

            $jadwal->push((object) [
                'id' => $syarat->id,
                'mahasiswa' => $syarat->mahasiswa,
                'nim' => $syarat->mahasiswa->nim ?? '-',
                'nama' => $syarat->mahasiswa->nama ?? '-',
                'jenis_ujian' => 'kolokium',
                'jenis_ujian_label' => 'Kolokium',
                'peran_dosen' => $peranDosen,
                'tanggal_ujian' => $syarat->kolokiummhs->tanggal ?? '-',
                'current_penilaian' => $penilaianDosen,
            ]);
        }

        // Format Seminar
        foreach ($seminarData as $syarat) {
            $peranDosen = $this->getPeranDosen($syarat, $dosenId, 'seminar');
            $penilaianDosen = $this->getPenilaianDosen($syarat, $dosenId);

            $jadwal->push((object) [
                'id' => $syarat->id,
                'mahasiswa' => $syarat->mahasiswa,
                'nim' => $syarat->mahasiswa->nim ?? '-',
                'nama' => $syarat->mahasiswa->nama ?? '-',
                'jenis_ujian' => 'seminar',
                'jenis_ujian_label' => 'Seminar Hasil',
                'peran_dosen' => $peranDosen,
                'tanggal_ujian' => $syarat->seminarmhs->tanggal ?? '-',
                'current_penilaian' => $penilaianDosen,
            ]);
        }

        // Format Komprehensif
        foreach ($komprehensifData as $syarat) {
            $peranDosen = $this->getPeranDosen($syarat, $dosenId, 'komprehensif');
            $penilaianDosen = $this->getPenilaianDosen($syarat, $dosenId);

            $jadwal->push((object) [
                'id' => $syarat->id,
                'mahasiswa' => $syarat->mahasiswa,
                'nim' => $syarat->mahasiswa->nim ?? '-',
                'nama' => $syarat->mahasiswa->nama ?? '-',
                'jenis_ujian' => 'komprehensif',
                'jenis_ujian_label' => 'Komprehensif',
                'peran_dosen' => $peranDosen,
                'tanggal_ujian' => $syarat->komprehensifmhs->tanggal ?? '-',
                'current_penilaian' => $penilaianDosen,
            ]);
        }

        // Sort by tanggal_ujian (terbaru dulu)
        $jadwal = $jadwal->sortByDesc('tanggal_ujian')->values();

        $perPage = 10;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $jadwal->forPage($page, $perPage)->values();

        $paginatedJadwal = new LengthAwarePaginator(
            $currentItems,
            $jadwal->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('penilaian.index', [
            'jadwal' => $paginatedJadwal,
        ]);
    }

    /**
     * Helper: Tentukan peran dosen dalam sidang tertentu
     */
    private function getPeranDosen($syarat, $dosenId, $jenis)
    {
        $roles = [];

        // Cek moderator/penguji (dari SyaratUjian)
        if ($syarat->id_moderator == $dosenId) {
            $roles[] = 'Moderator';
        }
        if ($syarat->id_penguji == $dosenId) {
            $roles[] = 'Penguji';
        }

        // Cek pembimbing (dari relasi jenis ujian)
        if ($jenis === 'kolokium' && $syarat->kolokiummhs) {
            if ($syarat->kolokiummhs->id_pembimbing1 == $dosenId) {
                $roles[] = 'Pembimbing 1';
            }
            if ($syarat->kolokiummhs->id_pembimbing2 == $dosenId) {
                $roles[] = 'Pembimbing 2';
            }            
        } elseif ($jenis === 'seminar' && $syarat->seminarmhs) {
            if ($syarat->seminarmhs->id_pembimbing1 == $dosenId) {
                $roles[] = 'Pembimbing 1';
            }
            if ($syarat->seminarmhs->id_pembimbing2 == $dosenId) {
                $roles[] = 'Pembimbing 2';
            }            
        } elseif ($jenis === 'komprehensif' && $syarat->komprehensifmhs) {
            if ($syarat->komprehensifmhs->id_pembimbing1 == $dosenId) {
                $roles[] = 'Pembimbing 1';
            }
            if ($syarat->komprehensifmhs->id_pembimbing2 == $dosenId) {
                $roles[] = 'Pembimbing 2';
            }            
        }

        return !empty($roles) ? implode(', ', $roles) : '-';
    }

    /**
     * Helper: Ambil penilaian dosen login untuk sidang tertentu
     */
    private function getPenilaianDosen($syarat, $dosenId)
    {
        return $syarat->penilaian()
            ->where(function ($q) use ($dosenId) {
                $q->where('id_moderator', $dosenId)
                    ->orWhere('id_penguji', $dosenId)
                    ->orWhere('id_pembimbing1', $dosenId)
                    ->orWhere('id_pembimbing2', $dosenId);
            })
            ->first();
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

        $totalBobot = Rubrik::where('jenis_sidang', $jenis)
            ->sum('bobot');

        if ($totalBobot != 100) {
            return redirect()
                ->route('penilaian.index')
                ->with(
                    'error',
                    'Penilaian tidak dapat dilakukan karena total bobot rubrik '.$jenis.' belum mencapai 100%.'
                );
        }

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

        $totalBobot = Rubrik::where('jenis_sidang', $jenis)
            ->sum('bobot');

        if ($totalBobot != 100) {
            return back()->with(
                'error',
                'Penilaian gagal disimpan karena total bobot rubrik belum 100%.'
            );
        }
        
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
