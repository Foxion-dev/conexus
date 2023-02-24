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
Auth::routes();
Route::get('/start', [App\Http\Controllers\WorkDayController::class, 'start'])->name('auth.start');
Route::post('/start', [App\Http\Controllers\WorkDayController::class, 'changeOffice'])->name('auth.office');
Route::get('/step2', [App\Http\Controllers\WorkDayController::class, 'step2'])->name('auth.step2');
Route::post('/step2', [App\Http\Controllers\WorkDayController::class, 'officeSetData'])->name('auth.office.data');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::resource('deal', \App\Http\Controllers\DealController::class);



//Route::get('/deals', [App\Http\Controllers\DealController::class, 'index'])->name('deal.index');
//Route::get('/deals/create', [App\Http\Controllers\DealController::class, 'create'])->name('deal.create');
//Route::post('deals', [App\Http\Controllers\DealController::class, 'store'])->name('deal.store');
//Route::get('deals/{deal}', [App\Http\Controllers\DealController::class, 'show'])->name('deal.show');
//Route::get('deals/{deal}/edit', [App\Http\Controllers\DealController::class, 'edit'])->name('deal.edit');
//Route::patch('deals/{deal}', [App\Http\Controllers\DealController::class, 'update'])->name('deal.update');
//Route::delete('deals/{deal}', [App\Http\Controllers\DealController::class, 'destroy'])->name('deal.destroy');

//Route::group(['namespace' => 'App\Http\Controllers\Deal'], function (){
//
//    Route::get('/deals', 'IndexController')->name('deal.index');
//    Route::get('/deals/create', 'CreateController')->name('deal.create');
//    Route::post('/deals', 'StoreController')->name('deal.store');
//    Route::get('/deals/{deal}', 'ShowController')->name('deal.show');
//    Route::get('/deals/{deal}/edit', 'EditController')->name('deal.edit');
//    Route::patch('/deals/{deal}', 'UpdateController')->name('deal.update');
//    Route::delete('/deals/{deal}', 'DestroyController')->name('deal.delete');
//});
