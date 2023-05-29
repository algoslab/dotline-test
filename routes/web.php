<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploader;
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

Route::get('/', [FileUploader::class, 'index'])->name('index');
Route::post('/data_form_submit', [FileUploader::class, 'data_form_submit'])->name('data_form_submit');
Route::get('/data_datatable', [FileUploader::class, 'data_datatable'])->name('data_datatable');
Route::get('/sample_file_download', [FileUploader::class, 'sample_file_download'])->name('sample_file_download');

