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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tes', function () {
    return view('layouts.base');
});
Route::get('admin/home', 'HomeController@handleAdmin')->name('admin.route')->middleware('admin');

Route::prefix('admin')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('list', 'Admin\UsersController@index')->name('admin.users.list');
        Route::get('show/{id}', 'Admin\UsersController@show')->name('admin.users.show');
        Route::get('get', 'Admin\UsersController@getData')->name('admin.users.get');
        Route::post('add', 'Admin\UsersController@store')->name('admin.users.add');
        Route::post('update/{id}', 'Admin\UsersController@update')->name('admin.users.update');
        Route::get('delete/{id}', 'Admin\UsersController@destroy');
    });
    Route::prefix('pegawai')->group(function () {
        Route::get('list', 'Admin\PegawaiController@index')->name('admin.pegawai.list');
        Route::get('get', 'Admin\PegawaiController@getPegawai')->name('admin.pegawai.get');
        Route::post('store', 'Admin\PegawaiController@store')->name('admin.pegawai.add');
        Route::post('cari', 'Admin\PegawaiController@cari')->name('pegawai.cari');
        Route::get('show/{id}', 'Admin\PegawaiController@show')->name('admin.pegawai.show');
        Route::put('update/{id}', 'Admin\PegawaiController@update')->name('admin.pegawai.update');
        Route::get('delete/{id}', 'Admin\PegawaiController@destroy')->name('admin.pegawai.destroy');
    });
    Route::prefix('dashboard')->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
    });
    Route::post('add/role', 'Admin\UsersController@addRole')->name('admin.add.role');
});

Route::prefix('surat')->group(function () {
    Route::get('list', 'Surat\SuratController@index')->name('surat.list');
    Route::get('get', 'Surat\SuratController@get')->name('surat.get');
    Route::post('add', 'Surat\SuratController@store')->name('surat.add');
    Route::get('export/{id}', 'Surat\SuratController@export')->name('surat.export');
    Route::get('show/{no}', 'Surat\SuratController@show')->name('surat.show');
    Route::put('update/{no}', 'Surat\SuratController@update')->name('surat.update');
    Route::prefix('kop')->group(function () {
        Route::get('list', 'Surat\KopController@index')->name('surat.kop.list');
        Route::get('get', 'Surat\KopController@get')->name('surat.kop.get');
        Route::post('add', 'Surat\KopController@store')->name('surat.kop.add');
    });
    Route::prefix('persetujuan')->group(function () {
        Route::get('list', 'Surat\SuratController@ttdList')->name('surat.persetujuan.list');
    });
});