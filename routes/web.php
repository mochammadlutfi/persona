<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/','HomeController@index')->name('home');
Route::get('/tentang-kami','HomeController@about')->name('about');

Route::get('/login','AuthController@showLogin')->name('login');
Route::post('/login','AuthController@login');
Route::get('/daftar','AuthController@showRegister')->name('register');
Route::post('/daftar','AuthController@register');

Route::prefix('/training')->name('training.')->group(function () {
    Route::get('/','TrainingController@index')->name('index');
    Route::get('/{slug}','TrainingController@show')->name('show');
});

Route::prefix('/request')->name('request.')->group(function () {
    Route::get('/','RequestController@index')->name('index');
    Route::get('/create','RequestController@create')->middleware('auth')->name('create');
    Route::post('/store','RequestController@store')->name('store');
});

Route::prefix('/promo')->name('promo.')->group(function () {
    Route::get('/','PromoController@index')->name('index');
    Route::get('/{slug}','PromoController@show')->name('show');
});
Route::middleware('auth')->group(function () {
    Route::post('/keluar','AuthController@logout')->name('logout');
    
    Route::name('profil.')->group(function () {
        Route::get('/profil','ProfilController@edit')->name('edit');
        Route::post('/profil','ProfilController@update');
        
        Route::get('/password','ProfilController@password')->name('password');
        Route::post('/password','ProfilController@updatePassword');
    });
        
    Route::get('/pelatihan-saya','TrainingController@user')->name('user.training');
    Route::get('/pelatihan-saya/{id}/invoice','TrainingController@invoice')->name('user.training.invoice');
    Route::get('/pelatihan-saya/{id}/pembayaran','TrainingController@payment')->name('user.training.payment');
    Route::post('/pelatihan-saya/{id}/update','TrainingController@update')->name('user.training.update');
    Route::post('/pelatihan/simpan','TrainingController@register')->name('user.training.register');    

    
    Route::get('/pengajuan-saya','RequestController@user')->name('user.request');
    Route::get('/pengajuan-saya/{id}','RequestController@show')->name('user.request.show');
    Route::post('pengajuan-saya/{id}/bayar','RequestController@bayar')->name('user.request.bayar');
});

Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    
    Route::middleware('guest:admin')->group(function () {
        Route::get('/','LoginController@showLoginForm')->name('login');
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout','LoginController@logout')->name('logout');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/password', [ProfileController::class, 'password'])->name('password');
        Route::post('/password', [ProfileController::class, 'passwordUpdate'])->name('password.update');

        Route::middleware('verified')->group(function () {
            Route::get('/beranda','BerandaController@index')->name('beranda');
            
            Route::prefix('/pelanggan')->name('user.')->group(function () {
                Route::get('/','UserController@index')->name('index');
                Route::get('/create','UserController@create')->name('create');
                Route::post('/store','UserController@store')->name('store');
                Route::get('/json/{id}','UserController@json')->name('json');
                Route::get('/{id}','UserController@show')->name('show');
                Route::get('/{id}/edit','UserController@edit')->name('edit');
                Route::post('{id}/update','UserController@update')->name('update');
                Route::delete('/{id}/delete','UserController@destroy')->name('delete');
                Route::get('/{id}/riwayat','UserController@riwayat')->name('riwayat');
            });

            Route::prefix('/training')->name('training.')->group(function () {
                Route::get('/','TrainingController@index')->name('index');
                Route::get('/create','TrainingController@create')->name('create');
                Route::post('/store','TrainingController@store')->name('store');
                Route::post('/status','TrainingController@status')->name('status');
                Route::get('/{id}','TrainingController@show')->name('show');
                Route::get('/{id}/edit','TrainingController@edit')->name('edit');
                Route::post('{id}/update','TrainingController@update')->name('update');
                Route::delete('/{id}/delete','TrainingController@destroy')->name('delete');
                Route::get('/{id}/peserta','UserTrainingController@index')->name('peserta');
                Route::post('/{id}/peserta/store','UserTrainingController@store')->name('peserta.store');
                Route::delete('/{id}/peserta/delete','UserTrainingController@destroy')->name('peserta.delete');
                Route::get('/{id}/peserta/{user}/certificate','UserTrainingController@certificate')->name('peserta.certificate');
            });

            Route::name('profil.')->group(function () {
                Route::get('/profil','ProfilController@edit')->name('edit');
                Route::post('/profil','ProfilController@update');
                
                Route::get('/password','ProfilController@password')->name('password');
                Route::post('/password','ProfilController@updatePassword');
            });

            Route::prefix('/promo')->name('promo.')->group(function () {
                Route::get('/','PromoController@index')->name('index');
                Route::get('/create','PromoController@create')->name('create');
                Route::post('/store','PromoController@store')->name('store');
                Route::get('/{id}','PromoController@show')->name('show');
                Route::get('/{id}/edit','PromoController@edit')->name('edit');
                Route::post('{id}/update','PromoController@update')->name('update');
                Route::delete('/{id}/delete','PromoController@destroy')->name('delete');
            });
            
            Route::prefix('/kategori')->name('kategori.')->group(function () {
                Route::get('/','KategoriController@index')->name('index');
                Route::post('/store','KategoriController@store')->name('store');
                Route::get('/{id}','KategoriController@show')->name('show');
                Route::get('/{id}/edit','KategoriController@edit')->name('edit');
                Route::post('/{id}/update','KategoriController@update')->name('store');
                Route::delete('/{id}/delete','KategoriController@destroy')->name('delete');
            });

            Route::prefix('/pendaftaran')->name('payment.')->group(function () {
                Route::get('/','PembayaranController@index')->name('index');
                Route::get('/create','PembayaranController@create')->name('create');
                Route::get('/report','PembayaranController@report')->name('report');
                Route::post('/store','PembayaranController@store')->name('store');
                Route::get('/{id}','PembayaranController@show')->name('show');
                Route::get('/{id}/edit','PembayaranController@edit')->name('edit');
                Route::post('{id}/update','PembayaranController@update')->name('update');
                Route::post('{id}/status','PembayaranController@status')->name('status');
                Route::delete('/{id}/delete','PembayaranController@destroy')->name('delete');
            });
        
            Route::prefix('/request')->name('request.')->group(function () {
                Route::get('/','RequestController@index')->name('index');
                Route::get('/report','PembayaranController@report')->name('report');
                Route::post('/store','RequestController@store')->name('store');
                Route::get('/{id}','RequestController@show')->name('show');
                Route::post('/{id}/status','RequestController@status')->name('status');
                Route::post('{id}/bayar','RequestController@bayar')->name('bayar');
            });

            Route::prefix('/program')->name('program.')->group(function () {
                Route::get('/','ProgramController@index')->name('index');
                Route::post('/store','ProgramController@store')->name('store');
                Route::get('/{id}','ProgramController@show')->name('show');
                Route::get('/{id}/edit','ProgramController@edit')->name('edit');
                Route::post('/{id}/update','ProgramController@update')->name('store');
                Route::delete('/{id}/delete','ProgramController@destroy')->name('delete');
            });
        });
    });
});


// require __DIR__.'/auth.php';
