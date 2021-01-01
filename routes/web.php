<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register'  => false,
    'reset'     => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('pengaturan', 'HomeController@pengaturan')->name('pengaturan');
	Route::get('database/backup', 'DatabaseController@backup')->name('database.backup');
	Route::post('database/restore', 'DatabaseController@restore')->name('database.restore');

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('akun/export', 'AkunController@export')->name('akun.export');
    Route::post('akun/import', 'AkunController@import')->name('akun.import');
    Route::delete('akun/destroys', 'AkunController@destroys')->name('akun.destroys');
    Route::resource('akun', 'AkunController');

    Route::get('jurnal-umum/laporan', 'JurnalUmumController@laporan')->name('jurnal-umum.laporan');
    Route::delete('jurnal-umum/delete/{jurnal_umum}', 'JurnalUmumController@delete')->name('jurnal-umum.delete');
    Route::delete('jurnal-umum/destroys', 'JurnalUmumController@destroys')->name('jurnal-umum.destroys');
    Route::resource('jurnal-umum', 'JurnalUmumController');

    Route::get('jurnal-penyesuaian/laporan', 'JurnalPenyesuaianController@laporan')->name('jurnal-penyesuaian.laporan');
    Route::delete('jurnal-penyesuaian/delete/{jurnal_penyesuaian}', 'JurnalPenyesuaianController@delete')->name('jurnal-penyesuaian.delete');
    Route::delete('jurnal-penyesuaian/destroys', 'JurnalPenyesuaianController@destroys')->name('jurnal-penyesuaian.destroys');
    Route::resource('jurnal-penyesuaian', 'JurnalPenyesuaianController');

    Route::get('jurnal-penutup', 'JurnalPenutupController@index')->name('jurnal-penutup.index');
    Route::get('buku-besar', 'BukuBesarController@index')->name('buku-besar.index');
    Route::get('neraca-lajur', 'NeracaLajurController@index')->name('neraca-lajur.index');
    Route::get('laporan/posisi-keuangan', 'LaporanController@posisi_keuangan')->name('laporan.posisi-keuangan');
    Route::get('laporan/laba-rugi', 'LaporanController@laba_rugi')->name('laporan.laba-rugi');
    Route::get('laporan/perubahan-ekuitas', 'LaporanController@perubahan_ekuitas')->name('laporan.perubahan-ekuitas');
});

