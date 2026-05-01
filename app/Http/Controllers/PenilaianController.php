<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Penilaian;
use App\Models\SyaratKolokiummhs;
use App\Models\SyaratSeminarmhs;
use App\Models\SyaratKomprehensifmhs;
use App\Models\StaffDept;
use App\Models\Rubrik;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
        $dosen = Auth::guard('staff')->user();

        $kolokium = SyaratKolokiummhs::with(['mahasiswa','kolokiummhs', 'penilaian'])
            ->where('status', 'disetujui')
            ->get()
            ->filter(function ($item) use ($dosen) {
                // Check if dosen is moderator or pembimbing
                return $item->id_moderator == $dosen->id || 
                       $item->kolokiummhs->id_pembimbing1 == $dosen->id || 
                       $item->kolokiummhs->id_pembimbing2 == $dosen->id;
            })
            ->map(function ($item) use ($dosen) {
                $item->jenis_ujian = 'Kolokium';
                $item->tanggal_ujian = $item->kolokiummhs->tanggal ?? null;
                
                // Determine dosen role
                $peran = [];
                if ($item->id_moderator == $dosen->id) {
                    $peran[] = 'Moderator';
                }
                if ($item->kolokiummhs && ($item->kolokiummhs->id_pembimbing1 == $dosen->id || $item->kolokiummhs->id_pembimbing2 == $dosen->id)) {
                    $peran[] = 'Pembimbing';
                }

                $item->current_penilaian = Penilaian::where('id_syarat_kolokiummhs', $item->id)
                    ->where(function ($query) use ($dosen) {
                        $query->where('id_moderator', $dosen->id)
                              ->orWhere('id_pembimbing1', $dosen->id)
                              ->orWhere('id_pembimbing2', $dosen->id);
                    })
                    ->first();

                $item->peran_dosen = implode(', ', $peran);
                return $item;
            });

        $seminar = SyaratSeminarmhs::with(['mahasiswa','seminarmhs', 'penilaian'])
            ->where('status', 'disetujui')
            ->get()
            ->filter(function ($item) use ($dosen) {
                // Check if dosen is moderator or pembimbing
                return $item->id_moderator == $dosen->id || 
                       $item->seminarmhs->id_pembimbing1 == $dosen->id || 
                       $item->seminarmhs->id_pembimbing2 == $dosen->id;
            })
            ->map(function ($item) use ($dosen) {
                $item->jenis_ujian = 'Seminar Hasil';
                $item->tanggal_ujian = $item->seminarmhs->tanggal ?? null;
                
                // Determine dosen role
                $peran = [];
                if ($item->id_moderator == $dosen->id) {
                    $peran[] = 'Moderator';
                }
                if ($item->seminarmhs && ($item->seminarmhs->id_pembimbing1 == $dosen->id || $item->seminarmhs->id_pembimbing2 == $dosen->id)) {
                    $peran[] = 'Pembimbing';
                }

                $item->current_penilaian = Penilaian::where('id_syarat_seminarmhs', $item->id)
                    ->where(function ($query) use ($dosen) {
                        $query->where('id_moderator', $dosen->id)
                              ->orWhere('id_pembimbing1', $dosen->id)
                              ->orWhere('id_pembimbing2', $dosen->id);
                    })
                    ->first();

                $item->peran_dosen = implode(', ', $peran);
                return $item;
            });

        $kompre = SyaratKomprehensifmhs::with(['mahasiswa','komprehensifmhs', 'penilaian'])
            ->where('status', 'disetujui')
            ->get()
            ->filter(function ($item) use ($dosen) {
                // Check if dosen is moderator, penguji, or pembimbing
                return $item->id_moderator == $dosen->id || 
                       $item->id_penguji == $dosen->id ||
                       $item->komprehensifmhs->id_pembimbing1 == $dosen->id || 
                       $item->komprehensifmhs->id_pembimbing2 == $dosen->id;
            })
            ->map(function ($item) use ($dosen) {
                $item->jenis_ujian = 'Komprehensif';
                $item->tanggal_ujian = $item->komprehensifmhs->tanggal ?? null;
                
                // Determine dosen role
                $peran = [];
                if ($item->id_moderator == $dosen->id) {
                    $peran[] = 'Ketua Sidang';
                }
                if ($item->id_penguji == $dosen->id) {
                    $peran[] = 'Penguji';
                }
                if ($item->komprehensifmhs && ($item->komprehensifmhs->id_pembimbing1 == $dosen->id || $item->komprehensifmhs->id_pembimbing2 == $dosen->id)) {
                    $peran[] = 'Pembimbing';
                }

                $item->current_penilaian = Penilaian::where('id_syarat_komprehensifmhs', $item->id)
                    ->where(function ($query) use ($dosen) {
                        $query->where('id_moderator', $dosen->id)
                              ->orWhere('id_penguji', $dosen->id)
                              ->orWhere('id_pembimbing1', $dosen->id)
                              ->orWhere('id_pembimbing2', $dosen->id);
                    })
                    ->first();

                $item->peran_dosen = implode(', ', $peran);
                return $item;
            });

        $jadwal = $kolokium
            ->concat($seminar)
            ->concat($kompre)
            ->sortByDesc('tanggal_ujian');

        return view('penilaian.index', compact(            
            'jadwal',            
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rawJenis = strtolower(trim($request->jenis ?? ''));

        if (str_contains($rawJenis, 'kolokium')) {
            $jenis = 'kolokium';
        } elseif (str_contains($rawJenis, 'seminar')) {
            $jenis = 'seminar';
        } elseif (str_contains($rawJenis, 'komprehensif')) {
            $jenis = 'komprehensif';
        } else {
            abort(404);
        }

        $rubriks = Rubrik::where('jenis_sidang', $jenis)->get();
        $id    = $request->id;

        if ($jenis === 'kolokium') {
            $data = SyaratKolokiummhs::with(['mahasiswa','kolokiummhs'])->findOrFail($id);
            $judul = $data->kolokiummhs->judul_kolokium ?? '-';
        } 
        elseif ($jenis === 'seminar') {
            $data = SyaratSeminarmhs::with(['mahasiswa','seminarmhs'])->findOrFail($id);
            $judul = $data->seminarmhs->judul_seminar ?? '-';
        } 
        elseif ($jenis === 'komprehensif') {
            $data = SyaratKomprehensifmhs::with(['mahasiswa','komprehensifmhs'])->findOrFail($id);
            $judul = $data->komprehensifmhs->judul_komprehensif ?? '-';
        } 
        else {
            abort(404);
        }

        return view('penilaian.create', compact('data','jenis','judul', 'rubriks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nilai' => 'required|array'
        ]);

        $id = $request->id;
        $jenis = $request->jenis;
        $penilaianIds = [];
        $totalScore = 0;

        $dosenId = Auth::guard('staff')->id();

        // 🔥 Tentukan data sidang + role
        if ($jenis === 'kolokium') {
            $dataSidang = SyaratKolokiummhs::with('kolokiummhs')->findOrFail($id);
            $sidang = $dataSidang->kolokiummhs;

        } elseif ($jenis === 'seminar') {
            $dataSidang = SyaratSeminarmhs::with('seminarmhs')->findOrFail($id);
            $sidang = $dataSidang->seminarmhs;

        } elseif ($jenis === 'komprehensif') {
            $dataSidang = SyaratKomprehensifmhs::with('komprehensifmhs')->findOrFail($id);
            $sidang = $dataSidang->komprehensifmhs;

        } else {
            abort(404);
        }

        // 🔥 Tentukan role dosen
        $roleField = null;

        // dd([
        //     'dosen_login' => $dosenId,
        //     'moderator' => $dataSidang->id_moderator,
        //     'penguji' => $dataSidang->id_penguji,
        //     'pembimbing1' => optional($sidang)->id_pembimbing1,
        //     'pembimbing2' => optional($sidang)->id_pembimbing2,
        // ]);

        if ($dataSidang->id_moderator == $dosenId) {
            $roleField = 'id_moderator';
        } elseif ($dataSidang->id_penguji == $dosenId) {
            $roleField = 'id_penguji';
        } elseif (optional($sidang)->id_pembimbing1 == $dosenId) {
            $roleField = 'id_pembimbing1';
        } elseif (optional($sidang)->id_pembimbing2 == $dosenId) {
            $roleField = 'id_pembimbing2';
        } else {
            abort(403, 'Anda tidak punya akses sebagai penilai');
        }

        // 🔁 Loop simpan nilai
        foreach ($request->nilai as $rubrikId => $nilai) {

            $rubrik = Rubrik::findOrFail($rubrikId);
            $bobot = $rubrik->bobot;

            $score = ($nilai / 4) * $bobot;

            $dataInsert = [
                $roleField => $dosenId, // 🔥 sekarang sudah aman
                'id_rubrik' => $rubrikId,
                'nilai' => $nilai,
                'score' => $score,
                'catatan' => $request->catatan,
            ];

            if ($jenis === 'kolokium') {
                $dataInsert['id_syarat_kolokiummhs'] = $id;
            } elseif ($jenis === 'seminar') {
                $dataInsert['id_syarat_seminarmhs'] = $id;
            } elseif ($jenis === 'komprehensif') {
                $dataInsert['id_syarat_komprehensifmhs'] = $id;
            }

            $penilaian = Penilaian::create($dataInsert);
            $penilaianIds[] = $penilaian->id;
            $totalScore += $score;
        }

        // Simpan nilai akhir
        Penilaian::whereIn('id', $penilaianIds)
            ->update(['nilai_akhir' => $totalScore]);

        return redirect()->route('penilaian.show', $penilaianIds[0])
            ->with('success', 'Penilaian berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penilaian $penilaian)
    {
        $penilaian->load(['rubrik']);
        $rubrik = $penilaian->rubrik;
        $jenis = strtolower($rubrik->jenis_sidang);
        
        $dosenId = Auth::guard('staff')->id();

        // rubrik + data sidang
        if ($jenis === 'kolokium') {
            $data = SyaratKolokiummhs::with(['mahasiswa','kolokiummhs'])->findOrFail($penilaian->id_syarat_kolokiummhs);
            $judul = $data->kolokiummhs->judul_kolokium ?? '-';
            $penilaians = Penilaian::where('id_syarat_kolokiummhs', $penilaian->id_syarat_kolokiummhs)
                ->where(function ($q) use ($dosenId) {
                    $q->where('id_moderator', $dosenId)
                    ->orWhere('id_penguji', $dosenId)
                    ->orWhere('id_pembimbing1', $dosenId)
                    ->orWhere('id_pembimbing2', $dosenId);
                })
                ->with('rubrik')
                ->get();
        } 
        elseif ($jenis === 'seminar') {
            $data = SyaratSeminarmhs::with(['mahasiswa','seminarmhs'])->findOrFail($penilaian->id_syarat_seminarmhs);
            $judul = $data->seminarmhs->judul_seminar ?? '-';
            $penilaians = Penilaian::where('id_syarat_seminarmhs', $penilaian->id_syarat_seminarmhs)
                ->where(function ($q) use ($dosenId) {
                    $q->where('id_moderator', $dosenId)
                    ->orWhere('id_penguji', $dosenId)
                    ->orWhere('id_pembimbing1', $dosenId)
                    ->orWhere('id_pembimbing2', $dosenId);
                })    
                ->with('rubrik')
                ->get();
        } 
        elseif ($jenis === 'komprehensif') {
            $data = SyaratKomprehensifmhs::with(['mahasiswa','komprehensifmhs'])->findOrFail($penilaian->id_syarat_komprehensifmhs);
            $judul = $data->komprehensifmhs->judul_komprehensif ?? '-';
            $penilaians = Penilaian::where('id_syarat_komprehensifmhs', $penilaian->id_syarat_komprehensifmhs)
                ->where(function ($q) use ($dosenId) {
                    $q->where('id_moderator', $dosenId)
                    ->orWhere('id_penguji', $dosenId)
                    ->orWhere('id_pembimbing1', $dosenId)
                    ->orWhere('id_pembimbing2', $dosenId);
                })
                ->with('rubrik')
                ->get();
        } 
        else {
            abort(404);
        }

        //penilaian untuk semua dosen
        if ($jenis === 'kolokium') {
            $allPenilaians = Penilaian::where('id_syarat_kolokiummhs', $penilaian->id_syarat_kolokiummhs)
                ->whereNotNull('nilai_akhir')
                ->get();
        }

        elseif ($jenis === 'seminar') {
            $allPenilaians = Penilaian::where('id_syarat_seminarmhs', $penilaian->id_syarat_seminarmhs)
                ->whereNotNull('nilai_akhir')
                ->get();
        }
        elseif ($jenis === 'komprehensif') {
            $allPenilaians = Penilaian::where('id_syarat_komprehensifmhs', $penilaian->id_syarat_komprehensifmhs)
                ->whereNotNull('nilai_akhir')
                ->get();
        }        
            else {
            abort(404);
        }        

        $nilaiPerDosen = $allPenilaians
            ->groupBy(function ($item) {

                if ($item->id_moderator) {
                    return 'moderator_' . $item->id_moderator;
                }

                if ($item->id_penguji) {
                    return 'penguji_' . $item->id_penguji;
                }

                if ($item->id_pembimbing1) {
                    return 'pembimbing1_' . $item->id_pembimbing1;
                }

                if ($item->id_pembimbing2) {
                    return 'pembimbing2_' . $item->id_pembimbing2;
                }

                return 'unknown';
            })
            ->map(function ($items) {

                $item = $items->first();

                // tentukan role + ambil dosen
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

        $jumlahPenilai = $nilaiPerDosen->count();

        $totalNilai = $nilaiPerDosen->sum('nilai_akhir');

        $rataRata = $jumlahPenilai > 0 
            ? $totalNilai / $jumlahPenilai 
            : null;
        
        return view('penilaian.show', compact(
            'data',
            'jenis',
            'judul',
            'penilaians',
            'nilaiPerDosen',
            'jumlahPenilai',
            'totalNilai',
            'rataRata'
        ));
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
