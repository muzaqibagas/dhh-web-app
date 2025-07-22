<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AcaraAkademikController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriKompetensiController;
use App\Http\Controllers\KolokiumController;
use App\Http\Controllers\KontenDeptController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\KurikulumDetailController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\ReviewAlumniController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\SmkController;
use App\Http\Controllers\StaffDeptController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\UndanganController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('acara-akademik', AcaraAkademikController::class);
// Route::resource('artikel', ArtikelController::class);
// Route::resource('divisi', DivisiController::class);
// Route::resource('galeri', GaleriController::class);
// Route::resource('jenjang', JenjangController::class);
// Route::resource('kategori', KategoriController::class);
// Route::resource('kategori-kompetensi', KategoriKompetensiController::class);
// Route::resource('kolokium', KolokiumController::class);
// Route::resource('konten-dept', KontenDeptController::class);
// Route::resource('kurikulum', KurikulumController::class); // sudah diperbaiki dari KurikulumContror
// Route::resource('kurikulum-detail', KurikulumDetailController::class);
// Route::resource('mata-kuliah', MataKuliahController::class);
// Route::resource('pembimbing', PembimbingController::class);
// Route::resource('review-alumni', ReviewAlumniController::class);
// Route::resource('ruangan', RuanganController::class);
// Route::resource('semester', SemesterController::class);
// Route::resource('seminar', SeminarController::class);
// Route::resource('sidang', SidangController::class);
// Route::resource('smk', SmkController::class);
// Route::resource('staff-dept', StaffDeptController::class);
// Route::resource('template', TemplateController::class);
// Route::resource('tipe', TipeController::class);
// Route::resource('undangan', UndanganController::class);
// Route::resource('user', UserController::class);

// Acara Akademik
Route::get('acara-akademik', [AcaraAkademikController::class, 'index'])->name('acara-akademik.index');
Route::get('acara-akademik/create', [AcaraAkademikController::class, 'create'])->name('acara-akademik.create');
Route::post('acara-akademik', [AcaraAkademikController::class, 'store'])->name('acara-akademik.store');
Route::get('acara-akademik/{acaraAkademik}', [AcaraAkademikController::class, 'show'])->name('acara-akademik.show');
Route::get('acara-akademik/{acaraAkademik}/edit', [AcaraAkademikController::class, 'edit'])->name('acara-akademik.edit');
Route::put('acara-akademik/{acaraAkademik}', [AcaraAkademikController::class, 'update'])->name('acara-akademik.update');
Route::delete('acara-akademik/{acaraAkademik}', [AcaraAkademikController::class, 'destroy'])->name('acara-akademik.destroy');

// Artikel
Route::get('artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
Route::post('artikel', [ArtikelController::class, 'store'])->name('artikel.store');
Route::get('artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
Route::put('artikel/{artikel}', [ArtikelController::class, 'update'])->name('artikel.update');
Route::delete('artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

// Divisi
Route::get('divisi', [DivisiController::class, 'index'])->name('divisi.index');
Route::get('divisi/create', [DivisiController::class, 'create'])->name('divisi.create');
Route::post('divisi', [DivisiController::class, 'store'])->name('divisi.store');
Route::get('divisi/{id}', [DivisiController::class, 'show'])->name('divisi.show');
Route::get('divisi/{id}/edit', [DivisiController::class, 'edit'])->name('divisi.edit');
Route::put('divisi/{id}', [DivisiController::class, 'update'])->name('divisi.update');
Route::delete('divisi/{id}', [DivisiController::class, 'destroy'])->name('divisi.destroy');

// Galeri
Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
Route::post('galeri', [GaleriController::class, 'store'])->name('galeri.store');
Route::get('galeri/{id}', [GaleriController::class, 'show'])->name('galeri.show');
Route::get('galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
Route::put('galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
Route::delete('galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

// Jenjang
Route::get('jenjang', [JenjangController::class, 'index'])->name('jenjang.index');
Route::get('jenjang/create', [JenjangController::class, 'create'])->name('jenjang.create');
Route::post('jenjang', [JenjangController::class, 'store'])->name('jenjang.store');
Route::get('jenjang/{jenjang}', [JenjangController::class, 'show'])->name('jenjang.show');
Route::get('jenjang/{jenjang}/edit', [JenjangController::class, 'edit'])->name('jenjang.edit');
Route::put('jenjang/{jenjang}', [JenjangController::class, 'update'])->name('jenjang.update');
Route::delete('jenjang/{jenjang}', [JenjangController::class, 'destroy'])->name('jenjang.destroy');

// Kategori
Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
Route::get('kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// KategoriKompetensi
Route::get('kategorikompetensi', [KategoriController::class, 'index'])->name('kategorikompetensi.index');
Route::get('kategorikompetensi/create', [KategoriController::class, 'create'])->name('kategorikompetensi.create');
Route::post('kategorikompetensi', [KategoriController::class, 'store'])->name('kategorikompetensi.store');
Route::get('kategorikompetensi/{id}', [KategoriController::class, 'show'])->name('kategorikompetensi.show');
Route::get('kategorikompetensi/{id}/edit', [KategoriController::class, 'edit'])->name('kategorikompetensi.edit');
Route::put('kategorikompetensi/{id}', [KategoriController::class, 'update'])->name('kategorikompetensi.update');
Route::delete('kategorikompetensi/{id}', [KategoriController::class, 'destroy'])->name('kategorikompetensi.destroy');

// Kolokium
Route::get('kolokium', [KolokiumController::class, 'index'])->name('kolokium.index');
Route::get('kolokium/create', [KolokiumController::class, 'create'])->name('kolokium.create');
Route::post('kolokium', [KolokiumController::class, 'store'])->name('kolokium.store');
Route::get('kolokium/{id}', [KolokiumController::class, 'show'])->name('kolokium.show');
Route::get('kolokium/{id}/edit', [KolokiumController::class, 'edit'])->name('kolokium.edit');
Route::put('kolokium/{id}', [KolokiumController::class, 'update'])->name('kolokium.update');
Route::delete('kolokium/{id}', [KolokiumController::class, 'destroy'])->name('kolokium.destroy');

// KontenDept
Route::get('konten-dept', [KontenDeptController::class, 'index'])->name('konten-dept.index');
Route::get('konten-dept/create', [KontenDeptController::class, 'create'])->name('konten-dept.create');
Route::post('konten-dept', [KontenDeptController::class, 'store'])->name('konten-dept.store');
Route::get('konten-dept/{id}', [KontenDeptController::class, 'show'])->name('konten-dept.show');
Route::get('konten-dept/{id}/edit', [KontenDeptController::class, 'edit'])->name('konten-dept.edit');
Route::put('konten-dept/{id}', [KontenDeptController::class, 'update'])->name('konten-dept.update');
Route::delete('konten-dept/{id}', [KontenDeptController::class, 'destroy'])->name('konten-dept.destroy');

// Kurikulum
Route::get('kurikulum', [KurikulumController::class, 'index'])->name('kurikulum.index');
Route::get('kurikulum/create', [KurikulumController::class, 'create'])->name('kurikulum.create');
Route::post('kurikulum', [KurikulumController::class, 'store'])->name('kurikulum.store');
Route::get('kurikulum/{id}', [KurikulumController::class, 'show'])->name('kurikulum.show');
Route::get('kurikulum/{id}/edit', [KurikulumController::class, 'edit'])->name('kurikulum.edit');
Route::put('kurikulum/{id}', [KurikulumController::class, 'update'])->name('kurikulum.update');
Route::delete('kurikulum/{id}', [KurikulumController::class, 'destroy'])->name('kurikulum.destroy');

// KurikulumDetail
Route::get('kurikulum-detail', [KurikulumDetailController::class, 'index'])->name('kurikulum-detail.index');
Route::get('kurikulum-detail/create', [KurikulumDetailController::class, 'create'])->name('kurikulum-detail.create');
Route::post('kurikulum-detail', [KurikulumDetailController::class, 'store'])->name('kurikulum-detail.store');
Route::get('kurikulum-detail/{id}', [KurikulumDetailController::class, 'show'])->name('kurikulum-detail.show');
Route::get('kurikulum-detail/{id}/edit', [KurikulumDetailController::class, 'edit'])->name('kurikulum-detail.edit');
Route::put('kurikulum-detail/{id}', [KurikulumDetailController::class, 'update'])->name('kurikulum-detail.update');
Route::delete('kurikulum-detail/{id}', [KurikulumDetailController::class, 'destroy'])->name('kurikulum-detail.destroy');

// MataKuliah
Route::get('mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah.index');
Route::get('mata-kuliah/create', [MataKuliahController::class, 'create'])->name('mata-kuliah.create');
Route::post('mata-kuliah', [MataKuliahController::class, 'store'])->name('mata-kuliah.store');
Route::get('mata-kuliah/{id}', [MataKuliahController::class, 'show'])->name('mata-kuliah.show');
Route::get('mata-kuliah/{id}/edit', [MataKuliahController::class, 'edit'])->name('mata-kuliah.edit');
Route::put('mata-kuliah/{id}', [MataKuliahController::class, 'update'])->name('mata-kuliah.update');
Route::delete('mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])->name('mata-kuliah.destroy');

// Pembimbing
Route::get('pembimbing', [PembimbingController::class, 'index'])->name('pembimbing.index');
Route::get('pembimbing/create', [PembimbingController::class, 'create'])->name('pembimbing.create');
Route::post('pembimbing', [PembimbingController::class, 'store'])->name('pembimbing.store');
Route::get('pembimbing/{id}', [PembimbingController::class, 'show'])->name('pembimbing.show');
Route::get('pembimbing/{id}/edit', [PembimbingController::class, 'edit'])->name('pembimbing.edit');
Route::put('pembimbing/{id}', [PembimbingController::class, 'update'])->name('pembimbing.update');
Route::delete('pembimbing/{id}', [PembimbingController::class, 'destroy'])->name('pembimbing.destroy');

// ReviewAlumni
Route::get('review-alumni', [ReviewAlumniController::class, 'index'])->name('review-alumni.index');
Route::get('review-alumni/create', [ReviewAlumniController::class, 'create'])->name('review-alumni.create');
Route::post('review-alumni', [ReviewAlumniController::class, 'store'])->name('review-alumni.store');
Route::get('review-alumni/{id}', [ReviewAlumniController::class, 'show'])->name('review-alumni.show');
Route::get('review-alumni/{id}/edit', [ReviewAlumniController::class, 'edit'])->name('review-alumni.edit');
Route::put('review-alumni/{id}', [ReviewAlumniController::class, 'update'])->name('review-alumni.update');
Route::delete('review-alumni/{id}', [ReviewAlumniController::class, 'destroy'])->name('review-alumni.destroy');

// Ruangan
Route::get('ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
Route::post('ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
Route::get('ruangan/{id}', [RuanganController::class, 'show'])->name('ruangan.show');
Route::get('ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
Route::put('ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
Route::delete('ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

// Semester
Route::get('semester', [SemesterController::class, 'index'])->name('semester.index');
Route::get('semester/create', [SemesterController::class, 'create'])->name('semester.create');
Route::post('semester', [SemesterController::class, 'store'])->name('semester.store');
Route::get('semester/{id}', [SemesterController::class, 'show'])->name('semester.show');
Route::get('semester/{id}/edit', [SemesterController::class, 'edit'])->name('semester.edit');
Route::put('semester/{id}', [SemesterController::class, 'update'])->name('semester.update');
Route::delete('semester/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');

// Seminar
Route::get('seminar', [SeminarController::class, 'index'])->name('seminar.index');
Route::get('seminar/create', [SeminarController::class, 'create'])->name('seminar.create');
Route::post('seminar', [SeminarController::class, 'store'])->name('seminar.store');
Route::get('seminar/{id}', [SeminarController::class, 'show'])->name('seminar.show');
Route::get('seminar/{id}/edit', [SeminarController::class, 'edit'])->name('seminar.edit');
Route::put('seminar/{id}', [SeminarController::class, 'update'])->name('seminar.update');
Route::delete('seminar/{id}', [SeminarController::class, 'destroy'])->name('seminar.destroy');

// Sidang
Route::get('sidang', [SidangController::class, 'index'])->name('sidang.index');
Route::get('sidang/create', [SidangController::class, 'create'])->name('sidang.create');
Route::post('sidang', [SidangController::class, 'store'])->name('sidang.store');
Route::get('sidang/{id}', [SidangController::class, 'show'])->name('sidang.show');
Route::get('sidang/{id}/edit', [SidangController::class, 'edit'])->name('sidang.edit');
Route::put('sidang/{id}', [SidangController::class, 'update'])->name('sidang.update');
Route::delete('sidang/{id}', [SidangController::class, 'destroy'])->name('sidang.destroy');

// SMK
Route::get('smk', [SmkController::class, 'index'])->name('smk.index');
Route::get('smk/create', [SmkController::class, 'create'])->name('smk.create');
Route::post('smk', [SmkController::class, 'store'])->name('smk.store');
Route::get('smk/{id}', [SmkController::class, 'show'])->name('smk.show');
Route::get('smk/{id}/edit', [SmkController::class, 'edit'])->name('smk.edit');
Route::put('smk/{id}', [SmkController::class, 'update'])->name('smk.update');
Route::delete('smk/{id}', [SmkController::class, 'destroy'])->name('smk.destroy');

// StaffDept
Route::get('staff-dept', [StaffDeptController::class, 'index'])->name('staff-dept.index');
Route::get('staff-dept/create', [StaffDeptController::class, 'create'])->name('staff-dept.create');
Route::post('staff-dept', [StaffDeptController::class, 'store'])->name('staff-dept.store');
Route::get('staff-dept/{id}', [StaffDeptController::class, 'show'])->name('staff-dept.show');
Route::get('staff-dept/{id}/edit', [StaffDeptController::class, 'edit'])->name('staff-dept.edit');
Route::put('staff-dept/{id}', [StaffDeptController::class, 'update'])->name('staff-dept.update');
Route::delete('staff-dept/{id}', [StaffDeptController::class, 'destroy'])->name('staff-dept.destroy');

// Template
Route::get('template', [TemplateController::class, 'index'])->name('template.index');
Route::get('template/create', [TemplateController::class, 'create'])->name('template.create');
Route::post('template', [TemplateController::class, 'store'])->name('template.store');
Route::get('template/{id}', [TemplateController::class, 'show'])->name('template.show');
Route::get('template/{id}/edit', [TemplateController::class, 'edit'])->name('template.edit');
Route::put('template/{id}', [TemplateController::class, 'update'])->name('template.update');
Route::delete('template/{id}', [TemplateController::class, 'destroy'])->name('template.destroy');

// Tipe
Route::get('tipe', [TipeController::class, 'index'])->name('tipe.index');
Route::get('tipe/create', [TipeController::class, 'create'])->name('tipe.create');
Route::post('tipe', [TipeController::class, 'store'])->name('tipe.store');
Route::get('tipe/{id}', [TipeController::class, 'show'])->name('tipe.show');
Route::get('tipe/{id}/edit', [TipeController::class, 'edit'])->name('tipe.edit');
Route::put('tipe/{id}', [TipeController::class, 'update'])->name('tipe.update');
Route::delete('tipe/{id}', [TipeController::class, 'destroy'])->name('tipe.destroy');

// Undangan
Route::get('undangan', [UndanganController::class, 'index'])->name('undangan.index');
Route::get('undangan/create', [UndanganController::class, 'create'])->name('undangan.create');
Route::post('undangan', [UndanganController::class, 'store'])->name('undangan.store');
Route::get('undangan/{id}', [UndanganController::class, 'show'])->name('undangan.show');
Route::get('undangan/{id}/edit', [UndanganController::class, 'edit'])->name('undangan.edit');
Route::put('undangan/{id}', [UndanganController::class, 'update'])->name('undangan.update');
Route::delete('undangan/{id}', [UndanganController::class, 'destroy'])->name('undangan.destroy');

// User
Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::get('user/create', [UserController::class, 'create'])->name('user.create');
Route::post('user', [UserController::class, 'store'])->name('user.store');
Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');