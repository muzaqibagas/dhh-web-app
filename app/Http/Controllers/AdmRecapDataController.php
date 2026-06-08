<?php

namespace App\Http\Controllers;

use App\Exports\AdmRecapMultiSheetExport;
use App\Models\Kolokiummhs;
use App\Models\Komprehensifmhs;
use App\Models\Seminarmhs;
use App\Models\SyaratUjian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;

class AdmRecapDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kolokium = Kolokiummhs::all()->keyBy('id_mahasiswa');
        $seminar = Seminarmhs::all()->keyBy('id_mahasiswa');
        $kompre = Komprehensifmhs::all()->keyBy('id_mahasiswa');

        $query = SyaratUjian::with('mahasiswa');
        if (request()->filled('search')) {
            $search = request()->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nim', 'like', "%$search%")
                    ->orWhere('nama', 'like', "%$search%");
            });
        }

        $syaratUjians = $query->get()->groupBy('id_mahasiswa');

        $recap = [];
        foreach ($syaratUjians as $idMahasiswa => $group) {
            $mahasiswa = $group->first()->mahasiswa;
            $nim = $mahasiswa?->nim ?? ($kolokium[$idMahasiswa]->nim ?? $seminar[$idMahasiswa]->nim ?? $kompre[$idMahasiswa]->nim ?? '-');
            $nama = $mahasiswa?->nama ?? ($kolokium[$idMahasiswa]->nama ?? $seminar[$idMahasiswa]->nama ?? $kompre[$idMahasiswa]->nama ?? '-');

            // Ambil data jika ada
            $kolokiumData = $kolokium[$idMahasiswa] ?? null;
            $seminarData = $seminar[$idMahasiswa] ?? null;
            $kompreData = $kompre[$idMahasiswa] ?? null;

            // Ambil identitas prioritas: kolokium > seminar > kompre
            $identitas = $kolokiumData ?? $seminarData ?? $kompreData ?? null;

            // Ambil pembimbing 1
            $pembimbing1 = '-';
            if ($identitas && ! empty($identitas->pembimbing1)) {
                $pembimbing1 = $identitas->pembimbing1;
                if ($this->isJson($pembimbing1)) {
                    $json = json_decode($pembimbing1, true);
                    $pembimbing1 = $json['nama'] ?? '-';
                }
            }

            // Ambil pembimbing 2
            $pembimbing2 = '-';
            if ($identitas && ! empty($identitas->pembimbing2)) {
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
                    $status = 'Lulus Semester Genap '.($tahun - 1).'/'.$tahun;
                } else {
                    $status = 'Lulus Semester Ganjil '.$tahun.'/'.($tahun + 1);
                }
            }

            // Ambil SKL dan status genap jika ada di kompre
            $ket_sem_ganjil = $kompreData ? ($kompreData->skl ? 'SKL sudah' : '-') : '-';
            $genap_2024_2025 = $kompreData->status ?? '-';

            $recap[] = [
                'id' => $idMahasiswa,
                'nama' => $nama,
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

        // Buat paginator untuk array $recap agar pagination tampil pada view
        $perPage = 10;
        $page = request()->get('page', 1);
        $collection = collect($recap)->sortByDesc('id')->values(); // Sortir berdasarkan id jika ada, atau berdasarkan nama/nim jika ingin alternatif lain

        // Jika ada parameter pencarian, filter koleksi recap berdasarkan nama atau nim
        if (request()->has('search')) {
            $search = strtolower(request()->search);
            $collection = $collection->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['nim'] ?? ''), $search) || str_contains(strtolower($item['nama'] ?? ''), $search);
            })->values();
        }

        $currentItems = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginatedRecap = new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'query' => request()->query(),
            ]
        );

        // Supaya view tetap menggunakan variable yang ada untuk links, set juga $admRecapData
        $admRecapData = $paginatedRecap;
        $recap = $paginatedRecap;

        return view('recapdata.index', compact('recap', 'admRecapData'));
    }

    private function isJson($string)
    {
        json_decode($string);

        return json_last_error() == JSON_ERROR_NONE;
    }

    public function updateSKL($nim)
    {
        $kolokium = Kolokiummhs::where('nim', $nim)->first();
        $seminar = Seminarmhs::where('nim', $nim)->first();
        $kompre = Komprehensifmhs::where('nim', $nim)->first();

        // ❌ BELUM ADA DATA SEMINAR & KOMPRE
        if (! $seminar && ! $kompre) {
            return redirect()->back()->withErrors([
                'skl' => 'SKL tidak dapat dikonfirmasi karena mahasiswa belum melaksanakan Seminar Hasil dan Ujian Komprehensif.',
            ]);
        }

        // ❌ BELUM SEMINAR (tanggal kosong)
        if (! $seminar || empty($seminar->tanggal)) {
            return redirect()->back()->withErrors([
                'skl' => 'SKL tidak dapat dikonfirmasi karena Seminar Hasil belum dilaksanakan.',
            ]);
        }

        // ❌ BELUM KOMPRE (tanggal kosong)
        if (! $kompre || empty($kompre->tanggal)) {
            return redirect()->back()->withErrors([
                'skl' => 'SKL tidak dapat dikonfirmasi karena Ujian Komprehensif belum dilaksanakan.',
            ]);
        }

        // ✅ SEMUA SYARAT TERPENUHI → BOLEH UPDATE
        $tanggalSKL = Carbon::now();

        $bulan = $tanggalSKL->month;
        $tahun = $tanggalSKL->year;

        if ($bulan >= 1 && $bulan <= 7) {
            $status = 'Lulus Semester Genap '.($tahun - 1).'/'.$tahun;
        } else {
            $status = 'Lulus Semester Ganjil '.$tahun.'/'.($tahun + 1);
        }

        $kompre->update([
            'skl' => 'SKL Sudah',
            'tanggal_skl' => $tanggalSKL,
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'SKL berhasil dikonfirmasi dan status diperbarui.');
    }

    public function export()
    {
        $filename = 'rekap_data_'.date('Y_m_d_His').'.xlsx';

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
