<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SyaratUjian;

echo 'total syarat: ' . SyaratUjian::count() . PHP_EOL;
echo 'total penilaian: ' . App\Models\Penilaian::count() . PHP_EOL;
$types = SyaratUjian::selectRaw('jenis_ujian, count(*) as c')->groupBy('jenis_ujian')->get();
foreach ($types as $type) {
    echo "{$type->jenis_ujian}: {$type->c}\n";
}
$withPen = SyaratUjian::has('penilaian')->selectRaw('jenis_ujian, count(*) as c')->groupBy('jenis_ujian')->get();
foreach ($withPen as $type) {
    echo "with penilaian {$type->jenis_ujian}: {$type->c}\n";
}
$group = SyaratUjian::with('penilaian')->orderBy('id', 'DESC')->take(30)->get();
echo "\nFirst 30 with penilaian query results:\n";
foreach ($group as $item) {
    echo "id={$item->id}, mahasiswa={$item->id_mahasiswa}, jenis={$item->jenis_ujian}, created_at={$item->created_at}, penilaian_count=" . $item->penilaian->count() . "\n";
}

$group2 = SyaratUjian::with('penilaian')->get()->groupBy('id_mahasiswa');
foreach ($group2 as $id => $items) {
    $has = [];
    foreach (['kolokium', 'seminar', 'komprehensif'] as $jenis) {
        $item = $items->firstWhere('jenis_ujian', $jenis);
        if ($item) {
            $avg = $item->penilaian->pluck('nilai_akhir')->filter()->avg();
            $has[$jenis] = ['syarat' => true, 'penilaian' => $item->penilaian->count(), 'avg' => $avg];
        } else {
            $has[$jenis] = ['syarat' => false, 'penilaian' => 0, 'avg' => null];
        }
    }
    if (array_sum(array_column($has, 'penilaian')) > 0) {
        echo "mahasiswa $id "; print_r($has);
    }
}
