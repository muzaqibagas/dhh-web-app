<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\SyaratUjian;
use Illuminate\Http\Request;
use carbon\Carbon;

class PenilaianAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Ambil semua mahasiswa dengan penilaian mereka
        $mahasiswaQuery = SyaratUjian::with([
            'mahasiswa',
            'penilaian' => function ($query) {
                $query->select('id_syarat_ujian', 'nilai_akhir');
            }
        ])
        ->distinct('id_mahasiswa')
        ->get()
        ->unique('id_mahasiswa')
        ->map(function ($ujian) {
            return [
                'id_mahasiswa' => $ujian->id_mahasiswa,
                'nim' => $ujian->mahasiswa->nim ?? '-',
                'nama' => $ujian->mahasiswa->nama ?? '-',
            ];
        })
        ->values();

        // Jika ada search, filter berdasarkan NIM atau Nama
        if ($search) {
            $mahasiswaQuery = $mahasiswaQuery->filter(function ($item) use ($search) {
                return stripos($item['nim'], $search) !== false || 
                       stripos($item['nama'], $search) !== false;
            })->values();
        }

        // Untuk setiap mahasiswa, ambil nilai untuk setiap jenis ujian
        $mahasiswa = collect($mahasiswaQuery)->map(function ($mhs) {
            $ujians = SyaratUjian::with([
                'penilaian' => function ($query) {
                    $query->select('id_syarat_ujian', 'nilai_akhir');
                }
            ])
            ->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get();

            // Hitung nilai rata-rata untuk setiap jenis ujian
            $kolokium = $ujians->where('jenis_ujian', 'kolokium')
                ->flatMap(fn($u) => $u->penilaian->pluck('nilai_akhir'))
                ->filter()
                ->avg();

            $seminar = $ujians->where('jenis_ujian', 'seminar')
                ->flatMap(fn($u) => $u->penilaian->pluck('nilai_akhir'))
                ->filter()
                ->avg();

            $komprehensif = $ujians->where('jenis_ujian', 'komprehensif')
                ->flatMap(fn($u) => $u->penilaian->pluck('nilai_akhir'))
                ->filter()
                ->avg();

            // Check apakah ada penilaian
            $hasPenilaian = $ujians->flatMap(fn($u) => $u->penilaian)->isNotEmpty();

            return [
                'id_mahasiswa' => $mhs['id_mahasiswa'],
                'nim' => $mhs['nim'],
                'nama' => $mhs['nama'],
                'kolokium' => $kolokium,
                'seminar' => $seminar,
                'komprehensif' => $komprehensif,
                'has_penilaian' => $hasPenilaian,
            ];
        })->values();

        // Paginate hasil
        $perPage = 10;
        $page = $request->input('page', 1);
        $penilaianadm = new \Illuminate\Pagination\LengthAwarePaginator(
            $mahasiswa->forPage($page, $perPage),
            $mahasiswa->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        $mahasiswa = $penilaianadm->items();

        return view('penilaianadm.index', compact('mahasiswa', 'penilaianadm', 'search'));
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
            'mahasiswa',
            'kolokiummhs',
            'seminarmhs',
            'komprehensifmhs'
        ])
        ->where('id_mahasiswa', $id_mahasiswa)
        ->get()
        ->map(function ($ujian) {

            // FLAG DOSEN
            $ujian->hasModerator = $ujian->penilaian
                ->whereNotNull('id_moderator')
                ->isNotEmpty();

            $ujian->hasPembimbing1 = $ujian->penilaian
                ->whereNotNull('id_pembimbing1')
                ->isNotEmpty();

            $ujian->hasPembimbing2 = $ujian->penilaian
                ->whereNotNull('id_pembimbing2')
                ->isNotEmpty();

            $ujian->hasPenguji = $ujian->penilaian
                ->whereNotNull('id_penguji')
                ->isNotEmpty();

            // GROUP RUBRIK
            $ujian->groupedRubrik = $ujian->penilaian
                ->groupBy('id_rubrik');

            // JUDUL
            $ujian->judul = match ($ujian->jenis_ujian) {
                'kolokium' => $ujian->kolokiummhs->judul_kolokium ?? '-',
                'seminar' => $ujian->seminarmhs->judul_seminar ?? '-',
                'komprehensif' => $ujian->komprehensifmhs->judul_tugasakhir ?? '-',
                default => '-',
            };

            // TANGGAL
            $tanggal = match ($ujian->jenis_ujian) {
                'kolokium' => $ujian->kolokiummhs->tanggal ?? null,
                'seminar' => $ujian->seminarmhs->tanggal ?? null,
                'komprehensif' => $ujian->komprehensifmhs->tanggal ?? null,
                default => null,
            };

            $ujian->tanggalPelaksanaan = $tanggal
                ? Carbon::parse($tanggal)
                    ->locale('id')
                    ->translatedFormat('d F Y')
                : '-';

            // NILAI AKHIR
            $ujian->nilaiModerator = $ujian->penilaian
                ->whereNotNull('id_moderator')
                ->pluck('nilai_akhir')
                ->filter()
                ->first();

            $ujian->nilaiPembimbing1 = $ujian->penilaian
                ->whereNotNull('id_pembimbing1')
                ->pluck('nilai_akhir')
                ->filter()
                ->first();

            $ujian->nilaiPembimbing2 = $ujian->penilaian
                ->whereNotNull('id_pembimbing2')
                ->pluck('nilai_akhir')
                ->filter()
                ->first();

            $ujian->nilaiPenguji = $ujian->penilaian
                ->whereNotNull('id_penguji')
                ->pluck('nilai_akhir')
                ->filter()
                ->first();

            $semuaNilai = collect([
                $ujian->nilaiModerator,
                $ujian->nilaiPembimbing1,
                $ujian->nilaiPembimbing2,
                $ujian->nilaiPenguji,
            ])->filter();

            $ujian->rataRata = $semuaNilai->isNotEmpty()
                ? $semuaNilai->avg()
                : null;

            return $ujian;
        });

        return view('penilaianadm.show', compact('ujians'));
    }
}
