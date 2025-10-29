<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AcaraAkademikController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\KategoriStaffController; 
use App\Http\Controllers\KategoriGaleriController;
use App\Http\Controllers\KategoriArtikelController;
use App\Http\Controllers\KolokiumController;
use App\Http\Controllers\KontenDeptController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\KontenJenjangController;
use App\Http\Controllers\ReviewAlumniController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\StaffDeptController;
use App\Http\Controllers\KetuaDHHController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UndanganController;
use App\Http\Controllers\UndanganKolokiumController;
use App\Http\Controllers\UndanganSeminarController;
use App\Http\Controllers\undanganKomprehensifController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EditPasswordAdmController;
use App\Http\Controllers\EditPasswordMhsController;
use App\Http\Controllers\AdmProfileController;
use App\Http\Controllers\AdmRecapDataController;

// ROUTE MAHASISWA
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginmhsController;
use App\Http\Controllers\DashboardmhsController;
use App\Http\Controllers\DashboardadmController;
use App\Http\Controllers\ProfilemhsController;
use App\Http\Controllers\FormulirlayananakademikmhsController;
use App\Http\Controllers\KolokiummhsController;
use App\Http\Controllers\SyaratKolokiummhsController;
use App\Http\Controllers\SeminarmhsController;
use App\Http\Controllers\SyaratSeminarmhsController;
use App\Http\Controllers\KomprehensifmhsController;
use App\Http\Controllers\SyaratKomprehensifmhsController;



// ROUTE ADMIN
Route::get('/', function () {
    return view('welcome');
});
Route::get('/artikeledit', function () {
    return view('artikel.edit');
});

Route::get('home', [Controller::class, 'home'])->name('guest.home');
Route::get('file', [Controller::class, 'file'])->name('guest.file');
Route::get('pendidikans11', [Controller::class, 'pendidikans1'])->name('guest.pendidikans1');
// Route::get('pendidikans2', [Controller::class, 'pendidikans2'])->name('guest.pendidikans2');
// Route::get('pendidikans3', [Controller::class, 'pendidikans3'])->name('guest.pendidikans3');
Route::get('gallery', [Controller::class, 'galleryguest'])->name('guest.gallery');
Route::get('artikelguest', [Controller::class, 'artikelguest'])->name('guest.artikel');
Route::get('artikeldetail', [Controller::class, 'artikeldetail'])->name('guest.artikeldetail');
Route::get('alumnikami', [Controller::class, 'alumnikami'])->name('guest.alumnikami');
Route::get('alumnidetail', [Controller::class, 'alumnidetail'])->name('guest.alumnidetail');
Route::get('staffdetail', [Controller::class, 'staffdetail'])->name('guest.staffdetail');

Route::get('email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); 
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admprofile.index');
    } else {
        return redirect()->route('profilemhs.edit');
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ke email kamu!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard-mahasiswa', function () {
        return view('profilemhs.edit'); // sesuaikan view-nya
    })->name('profilemhs');

    Route::get('/dashboard-admin', function () {
        return view('admprofile.index'); // sesuaikan view-nya
    })->name('admprofile');
});

Route::get('login', [LoginmhsController::class, 'index'])->name('login');
Route::post('login', [LoginmhsController::class, 'signin'])->name('login.signin');
Route::post('logout', [LoginmhsController::class, 'logout'])->name('login.logout');

Route::get('register', [RegisterController::class, 'index'])->name('register.index');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('editpassadm', [EditPasswordAdmController::class, 'index'])->name('editpassadm.index');
Route::get('editpassmhs', [EditPasswordMhsController::class, 'index'])->name('editpassmhs.index');


//ADMIN
// ROUTE MAHASISWA
Route::get('dashboardmhs', [DashboardmhsController::class, 'index'])->name('dashboardmhs.index');
Route::get('dashboardadm', [DashboardadmController::class, 'index'])->name('dashboardadm.index');
Route::get('profilemhs', [ProfilemhsController::class, 'index'])->name('profilemhs.index');
Route::get('profilemhs/edit', [ProfilemhsController::class, 'edit'])->name('profilemhs.edit');
Route::get('formulirlayananakademikmhs', [FormulirlayananakademikmhsController::class, 'index'])->name('formulirlayananakademikmhs.index');

// ROUTE ADMIN AKADEMIK
Route::get('admprofile', [AdmProfileController::class, 'index'])->name('admprofile.index');

// Acara Akademik
Route::get('acara-akademik', [AcaraAkademikController::class, 'index'])->name('acaraakademik.index');
Route::get('acara-akademik/create', [AcaraAkademikController::class, 'create'])->name('acaraakademik.create');
Route::post('acara-akademik', [AcaraAkademikController::class, 'store'])->name('acaraakademik.store');
Route::get('acara-akademik/{acaraAkademik}', [AcaraAkademikController::class, 'show'])->name('acaraakademik.show');
Route::get('acara-akademik/{acaraAkademik}/edit', [AcaraAkademikController::class, 'edit'])->name('acaraakademik.edit');
Route::put('acara-akademik/{acaraAkademik}', [AcaraAkademikController::class, 'update'])->name('acaraakademik.update');
Route::delete('acara-akademik/{acaraAkademik}', [AcaraAkademikController::class, 'destroy'])->name('acaraakademik.destroy');

// KategoriArtikel
Route::get('kategoriartikel', [KategoriArtikelController::class, 'index'])->name('kategoriartikel.index');
Route::get('kategoriartikel/create', [KategoriArtikelController::class, 'create'])->name('kategoriartikel.create');
Route::post('kategoriartikel', [KategoriArtikelController::class, 'store'])->name('kategoriartikel.store');
Route::get('kategoriartikel/{kategoriArtikel}', [KategoriArtikelController::class, 'show'])->name('kategoriartikel.show');
Route::get('kategoriartikel/{kategoriArtikel}/edit', [KategoriArtikelController::class, 'edit'])->name('kategoriartikel.edit');
Route::put('kategoriartikel/{kategoriArtikel}', [KategoriArtikelController::class, 'update'])->name('kategoriartikel.update');
Route::delete('kategoriartikel/{kategoriArtikel}', [KategoriArtikelController::class, 'destroy'])->name('kategoriartikel.destroy');

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
Route::get('divisi/{divisi}', [DivisiController::class, 'show'])->name('divisi.show');
Route::get('divisi/{divisi}/edit', [DivisiController::class, 'edit'])->name('divisi.edit');
Route::put('divisi/{divisi}', [DivisiController::class, 'update'])->name('divisi.update');
Route::delete('divisi/{divisi}', [DivisiController::class, 'destroy'])->name('divisi.destroy');

// KategoriGaleri
Route::get('kategorigaleri', [KategoriGaleriController::class, 'index'])->name('kategorigaleri.index');
Route::get('kategorigaleri/create', [KategoriGaleriController::class, 'create'])->name('kategorigaleri.create');
Route::post('kategorigaleri', [KategoriGaleriController::class, 'store'])->name('kategorigaleri.store');
Route::get('kategorigaleri/{kategoriGaleri}', [KategoriGaleriController::class, 'show'])->name('kategorigaleri.show');
Route::get('kategorigaleri/{kategoriGaleri}/edit', [KategoriGaleriController::class, 'edit'])->name('kategorigaleri.edit');
Route::put('kategorigaleri/{kategoriGaleri}', [KategoriGaleriController::class, 'update'])->name('kategorigaleri.update');
Route::delete('kategorigaleri/{kategoriGaleri}', [KategoriGaleriController::class, 'destroy'])->name('kategorigaleri.destroy');


// Galeri
Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
Route::post('galeri', [GaleriController::class, 'store'])->name('galeri.store');
Route::get('galeri/{galeri}', [GaleriController::class, 'show'])->name('galeri.show');
Route::get('galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
Route::put('galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
Route::delete('galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

// Jenjang
Route::get('jenjang', [JenjangController::class, 'index'])->name('jenjang.index');
Route::get('jenjang/create', [JenjangController::class, 'create'])->name('jenjang.create');
Route::post('jenjang', [JenjangController::class, 'store'])->name('jenjang.store');
Route::get('jenjang/{jenjang}', [JenjangController::class, 'show'])->name('jenjang.show');
Route::get('jenjang/{jenjang}/edit', [JenjangController::class, 'edit'])->name('jenjang.edit');
Route::put('jenjang/{jenjang}', [JenjangController::class, 'update'])->name('jenjang.update');
Route::delete('jenjang/{jenjang}', [JenjangController::class, 'destroy'])->name('jenjang.destroy');


// KontenJenjang
Route::get('kontenjenjang', [KontenJenjangController::class, 'index'])->name('kontenjenjang.index');
Route::get('kontenjenjang/create', [KontenJenjangController::class, 'create'])->name('kontenjenjang.create');
Route::post('kontenjenjang', [KontenJenjangController::class, 'store'])->name('kontenjenjang.store');
Route::get('kontenjenjang/{kontenJenjang}', [KontenJenjangController::class, 'show'])->name('kontenjenjang.show');
Route::get('kontenjenjang/{kontenJenjang}/edit', [KontenJenjangController::class, 'edit'])->name('kontenjenjang.edit'); 
Route::put('kontenjenjang/{kontenJenjang}', [KontenJenjangController::class, 'update'])->name('kontenjenjang.update');
Route::delete('kontenjenjang/{kontenJenjang}', [KontenJenjangController::class, 'destroy'])->name('kontenjenjang.destroy');

Route::get('/pendidikans1', [KontenJenjangController::class, 'pendidikan'])->defaults('jenjang.pendidikan', 'S1');
Route::get('/pendidikans2', [KontenJenjangController::class, 'pendidikan'])->defaults('jenjang.pendidikan', 'S2');
Route::get('/pendidikans3', [KontenJenjangController::class, 'pendidikan'])->defaults('jenjang.pendidikan', 'S3');

// KategoriStaff
Route::get('kategoristaff', [KategoriStaffController::class, 'index'])->name('kategoristaff.index');
Route::get('kategoristaff/create', [KategoriStaffController::class, 'create'])->name('kategoristaff.create');                                                                                      
Route::post('kategoristaff', [KategoriStaffController::class, 'store'])->name('kategoristaff.store');
Route::get('kategoristaff/{kategoriStaff}', [KategoriStaffController::class, 'show'])->name('kategoristaff.show');
Route::get('kategoristaff/{kategoriStaff}/edit', [KategoriStaffController::class, 'edit'])->name('kategoristaff.edit');                           
Route::put('kategoristaff/{kategoriStaff}', [KategoriStaffController::class, 'update'])->name('kategoristaff.update');
Route::delete('kategoristaff/{kategoriStaff}', [KategoriStaffController::class, 'destroy'])->name('kategoristaff.destroy');

// KontenDept
Route::get('konten-dept', [KontenDeptController::class, 'index'])->name('konten-dept.index');
Route::get('konten-dept/create', [KontenDeptController::class, 'create'])->name('konten-dept.create');
Route::post('konten-dept', [KontenDeptController::class, 'store'])->name('konten-dept.store');
Route::get('konten-dept/{kontenDept}', [KontenDeptController::class, 'show'])->name('konten-dept.show');
Route::get('sejarah/{kontenDept}', [KontenDeptController::class, 'sejarah'])->name('konten-dept.sejarah');
Route::get('konten-dept/{kontenDept}/edit', [KontenDeptController::class, 'edit'])->name('konten-dept.edit');
Route::put('konten-dept/{kontenDept}', [KontenDeptController::class, 'update'])->name('konten-dept.update');
Route::delete('konten-dept/{kontenDept}', [KontenDeptController::class, 'destroy'])->name('konten-dept.destroy');
                            
//Mitra
Route::get('mitra', [MitraController::class, 'index'])->name('mitra.index');
Route::get('mitra/create', [MitraController::class, 'create'])->name('mitra.create');
Route::post('mitra', [MitraController::class, 'store'])->name('mitra.store');
Route::get('mitra/{mitra}', [MitraController::class, 'show'])->name('mitra.show');
Route::get('mitra/{mitra}/edit', [MitraController::class, 'edit'])->name('mitra.edit');
Route::put('mitra/{mitra}', [MitraController::class, 'update'])->name('mitra.update');
Route::delete('mitra/{mitra}', [MitraController::class, 'destroy'])->name('mitra.destroy');

// ReviewAlumni
Route::get('review-alumni', [ReviewAlumniController::class, 'index'])->name('review-alumni.index');
Route::get('review-alumni/create', [ReviewAlumniController::class, 'create'])->name('review-alumni.create');
Route::post('review-alumni', [ReviewAlumniController::class, 'store'])->name('review-alumni.store');
Route::get('review-alumni/{reviewAlumni}', [ReviewAlumniController::class, 'show'])->name('review-alumni.show');
Route::get('review-alumni/{reviewAlumni}/edit', [ReviewAlumniController::class, 'edit'])->name('review-alumni.edit');
Route::put('review-alumni/{reviewAlumni}', [ReviewAlumniController::class, 'update'])->name('review-alumni.update');
Route::delete('review-alumni/{reviewAlumni}', [ReviewAlumniController::class, 'destroy'])->name('review-alumni.destroy');

// Ruangan
Route::get('ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
Route::post('ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
Route::get('ruangan/{ruangan}', [RuanganController::class, 'show'])->name('ruangan.show');
Route::get('ruangan/{ruangan}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
Route::put('ruangan/{ruangan}', [RuanganController::class, 'update'])->name('ruangan.update');
Route::delete('ruangan/{ruangan}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

// Kolokium
Route::get('kolokiummhs', [KolokiummhsController::class, 'index'])->name('kolokiummhs.index');
Route::get('kolokiummhs/create', [KolokiummhsController::class, 'create'])->name('kolokiummhs.create');
Route::post('kolokiummhs', [KolokiummhsController::class, 'store'])->name('kolokiummhs.store');     
Route::get('kolokiummhs/{kolokiummhs}', [KolokiummhsController::class, 'show'])->name('kolokiummhs.show');
Route::get('/kolokiummhs/{id}/pdf', [KolokiummhsController::class, 'generatePdf'])->name('kolokiummhs.pdf');
Route::get('kolokiummhs/{kolokiummhs}/edit', [KolokiummhsController::class, 'edit'])->name('kolokiummhs.edit');
Route::put('kolokiummhs/{kolokiummhs}', [KolokiummhsController::class, 'update'])->name('kolokiummhs.update');
Route::delete('kolokiummhs/{kolokiummhs}', [KolokiummhsController::class, 'destroy'])->name('kolokiummhs.destroy');     

// Syarat Kolokium
Route::get('syaratkolokiummhs', [SyaratKolokiummhsController::class, 'index'])->name('syaratkolokiummhs.index'); //syarat kolokium admin
Route::get('syaratkolokiummhs/create', [SyaratKolokiummhsController::class, 'create'])->name('syaratkolokiummhs.create'); //syarat kolokium mahasiswa form
Route::post('syaratkolokiummhs', [SyaratKolokiummhsController::class, 'store'])->name('syaratkolokiummhs.store'); //syarat kolokium mahasiswa form
Route::post('syaratkolokiummhs/{id}/reupload', [SyaratKolokiummhsController::class, 'reupload'])->name('syaratkolokiummhs.reupload');
Route::post('syaratkolokiummhs/{id}/setujui', [SyaratKolokiummhsController::class, 'setujui'])->name('syaratkolokiummhs.setujui'); //syarat kolokium admin
Route::post('syaratkolokiummhs/{id}/tolak', [SyaratKolokiummhsController::class, 'tolak'])->name('syaratkolokiummhs.tolak'); //syarat kolokium admin
Route::get('syaratkolokiummhs/{syaratKolokiummhs}', [SyaratKolokiummhsController::class, 'show'])->name('syaratkolokiummhs.show'); //syarat kolokium admin
Route::post('syaratkolokiummhs/{syaratKolokiummhs}/tambah-moderator', [SyaratKolokiummhsController::class, 'tambahModerator'])->name('syaratkolokiummhs.tambahModerator'); //syarat kolokium admin
Route::get('/undangankolokiummhs/{id}/pdf', [SyaratKolokiummhsController::class, 'downloadPdf'])->name('undangan.kolokium.pdf');
Route::post('/syaratkolokiummhs/{id}/bap-diterima', [SyaratKolokiummhsController::class, 'bapDiterima'])->name('syaratkolokiummhs.bap.diterima');
Route::post('/syaratkolokiummhs/{id}/bap-ditolak', [SyaratKolokiummhsController::class, 'bapDitolak'])->name('syaratkolokiummhs.bap.ditolak');

// Undangan Kolokium
Route::get('undangankolokium', [UndanganKolokiumController::class, 'index'])->name('undangankolokium.index');

// Seminar Mahasiswa form
Route::get('seminarmhs', [SeminarmhsController::class, 'index'])->name('seminarmhs.index');
Route::get('seminarmhs/create', [SeminarmhsController::class, 'create'])->name('seminarmhs.create');
Route::post('seminarmhs', [SeminarmhsController::class, 'store'])->name('seminarmhs.store');
Route::get('seminarmhs/{seminarmhs}', [SeminarmhsController::class, 'show'])->name('seminarmhs.show');
Route::get('/seminarmhs/{id}/pdf', [SeminarmhsController::class, 'generatePdf'])->name('seminarmhs.pdf');
Route::get('seminarmhs/{seminarmhs}/edit', [SeminarmhsController::class, 'edit'])->name('seminarmhs.edit');
Route::put('seminarmhs/{seminarmhs}', [SeminarmhsController::class, 'update'])->name('seminarmhs.update');
Route::delete('seminarmhs/{seminarmhs}', [SeminarmhsController::class, 'destroy'])->name('seminarmhs.destroy');

// Syarat Seminar
Route::get('syaratseminarmhs', [SyaratSeminarmhsController::class, 'index'])->name('syaratseminarmhs.index'); //syarat seminar admin
Route::get('syaratseminarmhs/create', [SyaratSeminarmhsController::class, 'create'])->name('syaratseminarmhs.create'); //syarat seminar mahasiswa form
Route::post('syaratseminarmhs', [SyaratSeminarmhsController::class, 'store'])->name('syaratseminarmhs.store'); //syarat seminar mahasiswa form
Route::post('syaratseminarmhs/{id}/reupload', [SyaratSeminarmhsController::class, 'reupload'])->name('syaratseminarmhs.reupload');
Route::post('syaratseminarmhs/{id}/setujui', [SyaratSeminarmhsController::class, 'setujui'])->name('syaratseminarmhs.setujui'); //syarat seminar admin
Route::post('syaratseminarmhs/{id}/tolak', [SyaratSeminarmhsController::class, 'tolak'])->name('syaratseminarmhs.tolak'); //syarat seminar admin
Route::get('syaratseminarmhs/{syaratSeminarmhs}', [SyaratSeminarmhsController::class, 'show'])->name('syaratseminarmhs.show'); //syarat seminar admin
Route::post('syaratseminarmhs/{syaratSeminarmhs}/tambah-moderator', [SyaratSeminarmhsController::class, 'tambahModerator'])->name('syaratseminarmhs.tambahModerator'); //syarat seminar admin
Route::get('/undanganseminarmhs/{id}/pdf', [SyaratSeminarmhsController::class, 'downloadPdf'])->name('undangan.seminar.pdf');
Route::post('/syaratseminarmhs/{id}/bap-diterima', [SyaratSeminarmhsController::class, 'bapDiterima'])->name('syaratseminarmhs.bap.diterima');
Route::post('/syaratseminarmhs/{id}/bap-ditolak', [SyaratSeminarmhsController::class, 'bapDitolak'])->name('syaratseminarmhs.bap.ditolak');

// Undangan Seminar
Route::get('undanganseminar', [UndanganSeminarController::class, 'index'])->name('undanganseminar.index');

// Sidang Akhir atau Komprehensif
Route::get('komprehensifmhs', [KomprehensifmhsController::class, 'index'])->name('komprehensifmhs.index');
Route::get('komprehensifmhs/create', [KomprehensifmhsController::class, 'create'])->name('komprehensifmhs.create');
Route::post('komprehensifmhs', [KomprehensifmhsController::class, 'store'])->name('komprehensifmhs.store');
Route::get('komprehensifmhs/{komprehensifmhs}', [KomprehensifmhsController::class, 'show'])->name('komprehensifmhs.show');
Route::get('komprehensifmhs/{id}/pdf', [KomprehensifmhsController::class, 'generatePdf'])->name('komprehensifmhs.pdf');
Route::get('komprehensifmhs/{komprehensifmhs}/edit', [KomprehensifmhsController::class, 'edit'])->name('komprehensifmhs.edit');
Route::put('komprehensifmhs/{komprehensifmhs}', [KomprehensifmhsController::class, 'update'])->name('komprehensifmhs.update');
Route::delete('komprehensifmhs/{komprehensifmhs}', [KomprehensifmhsController::class, 'destroy'])->name('komprehensifmhs.destroy');

// Syarat Komprehensif
Route::get('syaratkomprehensifmhs', [SyaratKomprehensifmhsController::class, 'index'])->name('syaratkomprehensifmhs.index');
Route::get('syaratkomprehensifmhs/create', [SyaratKomprehensifmhsController::class, 'create'])->name('syaratkomprehensifmhs.create'); //syarat seminar mahasiswa form
Route::post('syaratkomprehensifmhs', [SyaratKomprehensifmhsController::class, 'store'])->name('syaratkomprehensifmhs.store'); //syarat seminar mahasiswa form
Route::post('syaratkomprehensifmhs/{id}/reupload', [SyaratKomprehensifmhsController::class, 'reupload'])->name('syaratkomprehensifmhs.reupload');
Route::post('syaratkomprehensifmhs/{id}/setujui', [SyaratKomprehensifmhsController::class, 'setujui'])->name('syaratkomprehensifmhs.setujui'); //syarat seminar admin
Route::post('syaratkomprehensifmhs/{id}/tolak', [SyaratKomprehensifmhsController::class, 'tolak'])->name('syaratkomprehensifmhs.tolak'); //syarat seminar admin
Route::get('syaratkomprehensifmhs/{syaratKomprehensifmhs}', [SyaratKomprehensifmhsController::class, 'show'])->name('syaratkomprehensifmhs.show'); //syarat seminar admin
Route::post('syaratkomprehensifmhs/{syaratKomprehensifmhs}/tambah-moderator', [SyaratKomprehensifmhsController::class, 'tambahModerator'])->name('syaratkomprehensifmhs.tambahModerator'); //syarat seminar admin
Route::get('/undangankomprehensif/{id}/pdf', [SyaratkomprehensifmhsController::class, 'downloadPdf'])->name('undangan.komprehensif.pdf');
Route::post('/syaratkomprehensifmhs/{id}/bap-diterima', [SyaratkomprehensifmhsController::class, 'bapDiterima'])->name('syaratkomprehensifmhs.bap.diterima');
Route::post('/syaratkomprehensifmhs/{id}/bap-ditolak', [SyaratkomprehensifmhsController::class, 'bapDitolak'])->name('syaratkomprehensifmhs.bap.ditolak');


// Undangan Komprehensif
Route::get('undangankomprehensif', [UndanganKomprehensifController::class, 'index'])->name('undangankomprehensif.index');

// StaffDept
Route::get('staff-dept', [StaffDeptController::class, 'index'])->name('staffdept.index');
Route::get('staff-dept/create', [StaffDeptController::class, 'create'])->name('staffdept.create');
Route::post('staff-dept', [StaffDeptController::class, 'store'])->name('staffdept.store');
Route::get('staff-dept/{staffDept}/edit', [StaffDeptController::class, 'edit'])->name('staffdept.edit');
Route::put('staff-dept/{staffDept}', [StaffDeptController::class, 'update'])->name('staffdept.update');
Route::delete('staff-dept/{staffDept}', [StaffDeptController::class, 'destroy'])->name('staffdept.destroy');

// KETUADHH
Route::get('ketuadhh', [KetuaDHHController::class, 'index'])->name('ketuadhh.index');
Route::get('ketuadhh/create', [KetuaDHHController::class, 'create'])->name('ketuadhh.create');
Route::post('ketuadhh', [KetuaDHHController::class, 'store'])->name('ketuadhh.store');
Route::get('ketuadhh/{ketuaDHH}', [KetuaDHHController::class, 'show'])->name('ketuadhh.show');
Route::get('ketuadhh/{ketuaDHH}/edit', [KetuaDHHController::class, 'edit'])->name('ketuadhh.edit');
Route::put('ketuadhh/{ketuaDHH}', [KetuaDHHController::class, 'update'])->name('ketuadhh.update');
Route::delete('ketuadhh/{ketuaDHH}', [KetuaDHHController::class, 'destroy'])->name('ketuadhh.destroy');

// Template
Route::get('template', [TemplateController::class, 'index'])->name('template.index');

// Undangan
Route::get('undangan', [UndanganController::class, 'index'])->name('undangan.index');
Route::get('undangan/create', [UndanganController::class, 'create'])->name('undangan.create');
Route::post('undangan', [UndanganController::class, 'store'])->name('undangan.store');
Route::get('undangan/{undangan}', [UndanganController::class, 'show'])->name('undangan.show');
Route::get('undangan/{undangan}/edit', [UndanganController::class, 'edit'])->name('undangan.edit');
Route::put('undangan/{undangan}', [UndanganController::class, 'update'])->name('undangan.update');
Route::delete('undangan/{undangan}', [UndanganController::class, 'destroy'])->name('undangan.destroy');

// Recap Data Admin
Route::get('recapdata', [AdmRecapDataController::class, 'index'])->name('recapdata.index');
Route::post('/admrecapdata/skl/{nim}', [AdmRecapDataController::class, 'updateSKL']);
Route::get('/admrecapdata/export', [AdmRecapDataController::class, 'export'])->name('admrecapdata.export');

// User
Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');



