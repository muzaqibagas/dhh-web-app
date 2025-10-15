<?php

namespace App\Http\Controllers;

use App\Models\UndanganKolokium;
use App\Models\Kolokiummhs;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

class UndanganKolokiumController extends Controller
{

    public function downloadPdf($id)
    {
        $kolokiummhs = Kolokiummhs::findOrFail($id);
        $template = public_path('undangan/templateundangankolokium.pdf');
        $outputPath = public_path('undangan/undangankolokium');
        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }
        $output = $outputPath . "/{$kolokiummhs->nim}_undangankolokium.pdf";
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($template); 
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl);
        $pdf->SetFont('Times', '', 12);
        $pdf->SetXY(30, 125);
        $pdf->Cell(10, 6, '1', 0, 0, 'C'); // No

        // Nama & NIM
        $pdf->SetXY(50, 125);
        $pdf->MultiCell(60, 6, $kolokiummhs->mahasiswa->nama . "\n" . $kolokiummhs->nim, 0, 'L');

        // Hari / Tanggal
        $pdf->SetXY(115, 125);
        $pdf->MultiCell(40, 6, $kolokiummhs->hari . "\n" . $kolokiummhs->tanggal, 0, 'L');

        // Waktu / Tempat
        $pdf->SetXY(160, 125);
        $pdf->MultiCell(40, 6, $kolokiummhs->waktu . "\n" . $kolokiummhs->tempat, 0, 'L');

        // Judul + Dosen Pembimbing 1 + Dosen Pembimbing 2 + Moderator
        $pdf->SetXY(30, 110);
        $pdf->MultiCell(170, 6,
            $kolokiummhs->judul . "\n" .
            $kolokiummhs->dosen_pembimbing_1 . "\n" .
            $kolokiummhs->dosen_pembimbing_2 . "\n" .
            $kolokiummhs->dosen_moderator,
            0, 'L'
        );

        // Bagian bawah (tanda tangan)
        $pdf->SetXY(30, 200);
        $pdf->Cell(0, 6, 'Bogor, ' . $kolokiummhs->tanggal_surat, 0, 1, 'R');
        $pdf->SetXY(30, 210);
        $pdf->Cell(0, 6, 'Plt. Sekretaris Departemen,', 0, 1, 'R');
        $pdf->SetXY(30, 235);
        $pdf->Cell(0, 6, $kolokiummhs->nama_sekretaris, 0, 1, 'R');
        $pdf->SetXY(30, 240);
        $pdf->Cell(0, 6, 'NIP. ' . $kolokiummhs->nip_sekretaris, 0, 1, 'R');

        $pdf->Output($output, 'F');

        return response()->download($output);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('undangankolokium.index');
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
    public function show(UndanganKolokium $undanganKolokium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UndanganKolokium $undanganKolokium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UndanganKolokium $undanganKolokium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UndanganKolokium $undanganKolokium)
    {
        //
    }
}
