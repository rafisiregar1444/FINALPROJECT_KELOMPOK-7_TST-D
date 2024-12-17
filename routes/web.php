<?php

use App\Http\Controllers\AsideController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\PenyelenggaraController;
use App\Http\Controllers\PTController;
use App\Http\Controllers\DaftarPemimpinController;
use App\Http\Controllers\DokumenPendukung;
use App\Http\Controllers\ProgBeasiswaController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TentangLayananController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MyTicketController;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;


/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Menangani unggahan formulir

Route::post('/uploadImage', [UploadController::class, 'uploadImage']);

Route::get('uploadLogo/{filename}', function ($filename) {
    // Misalkan Anda memiliki direktori tempat menyimpan file-file logo
    $basePath = public_path('uploadLogo/');

    // Periksa apakah file dengan ekstensi .jpg ada
    if (file_exists($basePath . $filename . '.jpg')) {
        $filePath = $basePath . $filename . '.jpg';
        // Lakukan sesuatu dengan file JPG
    }
    // Periksa apakah file dengan ekstensi .png ada
    elseif (file_exists($basePath . $filename . '.png')) {
        $filePath = $basePath . $filename . '.png';
        // Lakukan sesuatu dengan file PNG
    }
    else {
        // Handle jika file tidak ditemukan
        return response('File not found', 404);
    }

    // Misalnya, kirim file sebagai respons
    return response()->file($filePath);
});


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);

});

Route::get('/logout', [SesiController::class, 'logout']);

Route::get('/roledashboard/{nama_pt}', [DashboardController::class, 'roledashboard']);



// Route::get('/home', function () {
//     return redirect('/dashboard');
// });

// Route::middleware(['auth'])->group(function (){
//     Route::get('/dashboard', [DashboardController::class, 'index']);
//     Route::get('/dashboard', [DashboardController::class, 'admin'])->middleware('userAkses:admin');
//     Route::get('/dashboard', [DashboardController::class, 'user'])->middleware('userAkses:user');
//     Route::get('/logout', [SesiController::class, 'logout']);
//     Route::get('/test', [DashboardController::class, 'test']);
// });

// Route::resource('penyelenggara', PenyelenggaraController::class);

// Route::get('/test', [DashboardController::class, 'test']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/tentang-sistem', [TentangLayananController::class, 'TentangSistem'])->name('tentang-sistem');
Route::post('/uploadImage', [TentangLayananController::class, 'uploadImage']);
Route::get('/deleteImage', [TentangLayananController::class, 'deleteImage'])->name('deleteimage');

Route::get('/deleteImage', [AsideController::class, 'showAside'])->name('showAside');


// <<<-----------PENYELENGGARA----------->>>
Route::group(['prefix' => '/'], function () { 
    Route::get('/listbp', [PenyelenggaraController::class, 'list'])->name('listbp');

    Route::get('/addbp', [PenyelenggaraController::class, 'new'])->name('addbp');
    Route::post('/store', [PenyelenggaraController::class, 'store'])->name('store');
    Route::get('/editbp/{id_yys_pt}', [PenyelenggaraController::class, 'edit'])->name('editbp');
    Route::put('/editbp/{id_yys_pt}', [PenyelenggaraController::class, 'update'])->name('updatebp');
    Route::get('/deletebp/{id_yys_pt}', [PenyelenggaraController::class, 'delete'])->name('deletebp');

    Route::get('/perubahanbp/{id_yys_pt}', [PenyelenggaraController::class, 'perubahan'])->name('perubahanbp');

    Route::get('/aktabp/{id_yys_pt}', [PenyelenggaraController::class, 'akta'])->name('aktabp');
    Route::post('/storeakta/{id_yys_pt}', [PenyelenggaraController::class, 'storeAkta'])->name('storeakta');
    Route::get('/aktaedit/{id_akta_yys}', [PenyelenggaraController::class, 'aktaEdit'])->name('aktaedit');
    Route::put('/aktaedit/{id_akta_yys}', [PenyelenggaraController::class, 'updateAkta'])->name('updateakta');
    Route::get('/deleteakta/{id_akta_yys}', [PenyelenggaraController::class, 'deleteAkta'])->name('deleteakta');

    Route::get('/aktaKUMHAM/{id_akta_yys}', [PenyelenggaraController::class, 'aktaKUMHAM'])->name('aktakumham');
    Route::get('/aktaKUMHAMnew/{id_akta_yys}', [PenyelenggaraController::class, 'aktaKUMHAMnew'])->name('aktakumhamnew');
    Route::post('/aktaKUMHAMstore/{id_akta_yys}', [PenyelenggaraController::class, 'aktaKUMHAMstore'])->name('aktakumhamstore');
    Route::post('/aktaKUMHAMajukan/{id_pengurus}', [PenyelenggaraController::class, 'ajukanKUMHAM'])->name('ajukankumham');
    Route::get('/aktaKUMHAMedit/{id_pengurus}', [PenyelenggaraController::class, 'aktaKUMHAMedit'])->name('aktakumhamedit');
    Route::put('/aktaKUMHAMedit/{id_pengurus}', [PenyelenggaraController::class, 'aktaKUMHAMupdate'])->name('aktakumhamupdate');
    Route::get('/aktaKUMHAMdelete/{id_pengurus}', [PenyelenggaraController::class, 'aktaKUMHAMdelete'])->name('aktakumhamdelete');
    Route::get('/aktaKUMHAMdeleteAjukan/{id_pengurus}', [PenyelenggaraController::class, 'deleteAjukanKUMHAM'])->name('deleteajukankumham');

    Route::get('/listdatapengurus', [PenyelenggaraController::class, 'listDataPengurus'])->name('listdatapengurus');

});

Route::group(['prefix' => '/'], function () { 
    Route::get('/listpts', [PTController::class, 'listPTS'])->name('listpts');
    Route::get('/listptsaktif', [PTController::class, 'listPTSAktif'])->name('listptsaktif');
    Route::get('/listptsbermasalah', [PTController::class, 'listPTSBermasalah'])->name('listptsbermasalah');
    Route::get('/listptstutup', [PTController::class, 'listPTSTutup'])->name('listptstutup');

    Route::get('/AddPTS', [PTController::class, 'add'])->name('addpts');
    Route::post('/StorePTS', [PTController::class, 'store'])->name('storepts');
    Route::get('/EditPTS/{id_pts}', [PTController::class, 'edit'])->name('editpts');
    Route::put('/UpdatePTS/{id_pts}', [PTController::class, 'update'])->name('updatepts');
    Route::get('/perubahanstatusPTS/{id_pts}', [PTController::class, 'perubahanstatus'])->name('perubahanstatus');
    Route::put('/updatestatusPTS/{id_pts}', [PTController::class, 'updatePerubahanStatus'])->name('updateperubahanstatus');
    Route::get('/ajukanAkreditasi', [PTController::class, 'AjukanAkreditasi'])->name('ajukanakreditasi');
    Route::post('/ajukanAkreditasiPost/{id_pts}', [PTController::class, 'AjukanAkreditasiPost'])->name('ajukanakreditasipost');

    Route::get('/prodiPT/{id_pts}', [PTController::class, 'ProdiPT'])->name('prodipt');
    Route::get('/prodiPTnew/{id_pts}', [PTController::class, 'ProdiPTnew'])->name('prodiptnew');
    Route::post('/prodiPTstore/{id_pts}', [PTController::class, 'ProdiPTstore'])->name('prodiptstore');
    Route::get('/prodiPTedit/{id_prodi_pts}', [PTController::class, 'ProdiPTedit'])->name('prodiptedit');
    Route::put('/prodiPTupdate/{id_prodi_pts}', [PTController::class, 'ProdiPTupdate'])->name('prodiptupdate');
    Route::get('/deleteProdi/{id_prodi_pts}', [PTController::class, 'DeleteProdi'])->name('deleteprodi');

    Route::get('/daftarBP/{id_pts}', [PTController::class, 'DaftarBP'])->name('daftarbp');
    Route::post('/daftarBPstore/{id_pts}', [PTController::class, 'DaftarBPstore'])->name('daftarbpstore');

    Route::get('/akreditasiPT/{id_pts}', [PTController::class, 'AkreditasiPT'])->name('akreditasipt');
    Route::get('/akreditasiPTnew/{id_pts}', [PTController::class, 'AkreditasiPTnew'])->name('akreditasiptnew');
    Route::post('/akreditasiPTstore/{id_pts}', [PTController::class, 'AkreditasiPTstore'])->name('akreditasiptstore');
    Route::get('/akreditasiPTedit/{id_akreditasi}', [PTController::class, 'AkreditasiPTedit'])->name('akreditasiptedit');
    Route::put('/akreditasiPTupdate/{id_akreditasi}', [PTController::class, 'AkreditasiPTupdate'])->name('akreditasiptupdate');
    Route::get('/deleteakreditasi/{id_akreditasi}', [PTController::class, 'DeleteAkreditasi'])->name('deleteakreditasi');


    Route::get('/catatanPT/{id_pts}', [PTController::class, 'CatatanPT'])->name('catatanpt');
    Route::post('/catatanPTstore/{id_pts}', [PTController::class, 'CatatanPTstore'])->name('catatanptstore');

    Route::get('/catatanPTedit/{id_pts}', [PTController::class, 'CatatanPTedit'])->name('catatanptedit');
    Route::put('/catatanPTupdate/{id_pts}', [PTController::class, 'CatatanPTupdate'])->name('catatanptupdate');

    Route::get('/akreditasiPS/{id_prodi_pts}', [PTController::class, 'AkreditasiPS'])->name('akreditasips');
    Route::get('/akreditasiPSnew/{id_prodi_pts}', [PTController::class, 'AkreditasiPSnew'])->name('akreditasipsnew');
    Route::post('/akreditasiPSstore/{id_prodi_pts}', [PTController::class, 'AkreditasiPSstore'])->name('akreditasipsstore');
    Route::get('/akreditasiPSedit/{id_akreditasi}', [PTController::class, 'AkreditasiPSedit'])->name('akreditasipsedit');
    Route::put('/akreditasiPSupdate/{id_akreditasi}', [PTController::class, 'AkreditasiPSupdate'])->name('akreditasipsupdate');
    Route::get('/deleteakreditasiprodi/{id_akreditasi}', [PTController::class, 'DeleteAkreditasiPS'])->name('deleteakreditasips');

    Route::get('/deleteperguruantinggi/{id_pts}', [PTController::class, 'DeletePT'])->name('deletept');

});

Route::group(['prefix' => '/'], function () { 
    Route::get('/daftarpemimpin', [DaftarPemimpinController::class, 'DaftarPemimpin'])->name('daftarpemimpin');
    Route::get('/daftarpejabat/{id_pts}', [DaftarPemimpinController::class, 'DaftarPejabat'])->name('daftarpejabat');

    Route::get('/daftarpejabatnew/{id_pts}', [DaftarPemimpinController::class, 'NewDaftarPejabat'])->name('newdaftarpejabat');
    Route::post('/daftarpejabatstore/{id_pts}', [DaftarPemimpinController::class, 'StoreDaftarPejabat'])->name('storedaftarpejabat');
    Route::get('/daftarpejabatedit/{id_pimpinan}', [DaftarPemimpinController::class, 'EditDaftarPejabat'])->name('editdaftarpejabat');
    Route::put('/daftarpejabatupdate/{id_pimpinan}', [DaftarPemimpinController::class, 'UpdateDaftarPejabat'])->name('updatedaftarpejabat');
    Route::get('/daftarpejabatdelete/{id_pimpinan}', [DaftarPemimpinController::class, 'DeleteDaftarPejabat'])->name('deletedaftarpejabat');
    
});

Route::group(['prefix' => '/'], function () { 
    Route::get('/listdokung', [DokumenPendukung::class, 'Dokung'])->name('listdokung');

    Route::get('/adddokumen', [DokumenPendukung::class, 'DokungNew'])->name('adddokumen');
    Route::post('/storedokumen', [DokumenPendukung::class, 'DokungStore'])->name('storedokumen');
    Route::get('/editdokumen/{id_dok}', [DokumenPendukung::class, 'DokungEdit'])->name('editdokumen');
    Route::put('/updatedokumen/{id_dok}', [DokumenPendukung::class, 'DokungUpdate'])->name('updatedokumen');
    Route::get('/deletedokumen/{id_dok}', [DokumenPendukung::class, 'DokungDelete'])->name('deletedokumen');
});

Route::group(['prefix' => '/'], function () { 
    Route::get('/programbeasiswa', [ProgBeasiswaController::class, 'ProgramBeasiswa'])->name('programbeasiswa');

    Route::get('/addbeasiswa', [ProgBeasiswaController::class, 'ProgramBeasiswaNew'])->name('addbeasiswa');
    Route::post('/storebeasiswa', [ProgBeasiswaController::class, 'ProgramBeasiswaStore'])->name('storebeasiswa');
    Route::get('/editbeasiswa/{id_beasiswa}', [ProgBeasiswaController::class, 'ProgramBeasiswaEdit'])->name('editbeasiswa');
    Route::put('/updatebeasiswa/{id_beasiswa}', [ProgBeasiswaController::class, 'ProgramBeasiswaUpdate'])->name('updatebeasiswa');
    Route::get('/deletebeasiswa/{id_beasiswa}', [ProgBeasiswaController::class, 'ProgramBeasiswaDelete'])->name('deletebeasiswa');

    Route::get('/komponenbeasiswa/{id_beasiswa}', [ProgBeasiswaController::class, 'komponenbeasiswa'])->name('komponenbeasiswa');
    Route::post('/storekomponenbeasiswa', [ProgBeasiswaController::class, 'komponenbeasiswaStore'])->name('storekomponenbeasiswa');
    Route::get('/komponenbeasiswaedit/{id}', [ProgBeasiswaController::class, 'komponenbeasiswaEdit'])->name('komponenbeasiswaedit');
    Route::put('/komponenbeasiswaupdate/{id}', [ProgBeasiswaController::class, 'komponenbeasiswaUpdate'])->name('komponenbeasiswaupdate');
    Route::get('/komponenbeasiswadelete/{id}', [ProgBeasiswaController::class, 'komponenbeasiswaDelete'])->name('komponenbeasiswadelete');


    Route::post('/storepengajuankuota', [ProgBeasiswaController::class, 'StorePengajuanKuota'])->name('storepengajuankuota');
    Route::get('/deletepengajuankuota/{id}', [ProgBeasiswaController::class, 'DeletePengajuanKuota'])->name('deletepengajuankuota');

});

Route::group(['prefix' => '/'], function () { 
    Route::get('/listlomba', [LombaController::class, 'Lomba'])->name('listlomba');

    Route::get('/addlomba', [LombaController::class, 'LombaNew'])->name('addlomba');
    Route::post('/storelomba', [LombaController::class, 'LombaStore'])->name('storelomba');
    Route::get('/editlomba/{id_lomba}', [LombaController::class, 'LombaEdit'])->name('editlomba');
    Route::put('/updatelomba/{id_lomba}', [LombaController::class, 'LombaUpdate'])->name('updatelomba');
    Route::get('/deletelomba/{id_lomba}', [LombaController::class, 'LombaDelete'])->name('deletelomba');
});

Route::group(['prefix' => '/'], function () { 
    Route::get('/listuser', [UserController::class, 'List'])->name('listuser');

    Route::get('/adduser', [UserController::class, 'userAdd'])->name('adduser');
    Route::post('/storeuser', [UserController::class, 'userStore'])->name('storeuser');
    Route::get('/edituser/{id_userx}', [UserController::class, 'userEdit'])->name('edituser');
    Route::put('/updateuser/{id_userx}', [UserController::class, 'userUpdate'])->name('updateuser');
    Route::get('/deleteuser/{id_userx}', [UserController::class, 'userDelete'])->name('deleteuser');

    Route::get('/addusermahasiswa', [UserController::class, 'userAddmahasiswa'])->name('addusermahasiswa');

    Route::get('/roleuserbaru/{id_userx}', [UserController::class, 'roleuserEdit'])->name('roleedit');
    Route::put('/roleuserupdate/{id_userx}', [UserController::class, 'roleuserUpdate'])->name('roleupdate');

    Route::get('/resetuserpass/{id_userx}', [UserController::class, 'userResetPass'])->name('resetuserpass');
    Route::put('/resetuserpassupdate/{id_userx}', [UserController::class, 'userResetPassUpdate'])->name('resetuserpassupdate');

    Route::get('/profile/{id_userx}', [UserController::class, 'Profile'])->name('profile');
    Route::post('/uploadImage/{id_userx}', [UserController::class, 'uploadImage'])->name('uploadImage');
    Route::get('/deleteimage', [UserController::class, 'deleteImage'])->name('deleteimage');

});
Route::group(['prefix' => '/mahasiswa'], function () { 

    Route::get('/listmahasiswa', action: [MahasiswaController::class, 'ListMahasiswa'])->name('listmahasiswa');

    Route::get('/lombamahasiswa/{id_userx}', action: [MahasiswaController::class, 'LombaMahasiswa'])->name('lombamahasiswa');
    Route::get('/pengajuanlombam/{id_userx}', action: [MahasiswaController::class, 'PengajuanLombaM'])->name('pengajuanlombam');
    Route::post('/storepengajuanlombam/{id_userx}', action: [MahasiswaController::class, 'StorePengajuanLombaM'])->name('storepengajuanlombam');
    Route::get('/editpengajuanlombam/{id_lomba_mahasiswa}', [MahasiswaController::class, 'EditPengajuanLombaM'])->name('editpengajuanlombam');
    Route::put('/updatepengajuanlombam/{id_lomba_mahasiswa}', [MahasiswaController::class, 'UpdatePengajuanLombaM'])->name('updatepengajuanlombam');
    Route::get('/deletepengajuanlombam/{id_lomba_mahasiswa}', [MahasiswaController::class, 'DeletePengajuanLombaM'])->name('deletepengajuanlombam');

    Route::get('iisma', [MyTicketController::class, 'iisma'])->name('iisma');
    Route::post('iisma', [MyTicketController::class, 'iismaFunc']);
    Route::get('inspiba', [MyTicketController::class, 'inspiba'])->name('inspiba');
    Route::post('inspiba', [MyTicketController::class, 'inspibaFunc']);

});


use App\Http\Controllers\VoucherController;

Route::any('/soap/voucher', [VoucherController::class, 'iisma']);
Route::any('/soap/voucher2', [VoucherController::class, 'inspiba']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


