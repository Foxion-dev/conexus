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
Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history');


Route::get('/deals', [App\Http\Controllers\DealController::class, 'index'])->name('deal.index');
Route::get('/deals/create', [App\Http\Controllers\DealController::class, 'create'])->name('deal.create');
Route::post('deals', [App\Http\Controllers\DealController::class, 'store'])->name('deal.store');
Route::get('deals/{deal}', [App\Http\Controllers\DealController::class, 'show'])->name('deal.show');
Route::get('deals/{deal}/edit', [App\Http\Controllers\DealController::class, 'edit'])->name('deal.edit');
Route::patch('deals/{deal}', [App\Http\Controllers\DealController::class, 'update'])->name('deal.update');
Route::delete('deals/{deal}', [App\Http\Controllers\DealController::class, 'destroy'])->name('deal.destroy');

Route::get('/expenses', [App\Http\Controllers\ExpenseController::class, 'index'])->name('expense.index');
Route::get('/expenses/create', [App\Http\Controllers\ExpenseController::class, 'create'])->name('expense.create');
Route::post('expenses', [App\Http\Controllers\ExpenseController::class, 'store'])->name('expense.store');
Route::get('expenses/{expense}', [App\Http\Controllers\ExpenseController::class, 'show'])->name('expense.show');
Route::get('expenses/{expense}/edit', [App\Http\Controllers\ExpenseController::class, 'edit'])->name('expense.edit');
Route::patch('expenses/{expense}', [App\Http\Controllers\ExpenseController::class, 'update'])->name('expense.update');
Route::delete('expenses/{expense}', [App\Http\Controllers\ExpenseController::class, 'destroy'])->name('expense.destroy');

Route::get('/encashments', [App\Http\Controllers\EncashmentController::class, 'index'])->name('encashment.index');
Route::get('/encashments/create', [App\Http\Controllers\EncashmentController::class, 'create'])->name('encashment.create');
Route::post('encashments', [App\Http\Controllers\EncashmentController::class, 'store'])->name('encashment.store');
Route::get('encashments/{encashment}', [App\Http\Controllers\EncashmentController::class, 'show'])->name('encashment.show');
Route::get('encashments/{encashment}/edit', [App\Http\Controllers\EncashmentController::class, 'edit'])->name('encashment.edit');
Route::patch('encashments/{encashment}', [App\Http\Controllers\EncashmentController::class, 'update'])->name('encashment.update');
Route::delete('encashments/{encashment}', [App\Http\Controllers\EncashmentController::class, 'destroy'])->name('encashment.destroy');

Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('client.index');
Route::get('/clients/create', [App\Http\Controllers\ClientController::class, 'create'])->name('client.create');
Route::post('clients', [App\Http\Controllers\ClientController::class, 'store'])->name('client.store');
Route::get('clients/{client}', [App\Http\Controllers\ClientController::class, 'show'])->name('client.show');
Route::get('clients/{client}/edit', [App\Http\Controllers\ClientController::class, 'edit'])->name('client.edit');
Route::patch('clients/{client}', [App\Http\Controllers\ClientController::class, 'update'])->name('client.update');
Route::delete('clients/{client}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('client.destroy');


Route::get('/sources', [App\Http\Controllers\SourceController::class, 'index'])->name('source.index');
Route::get('/sources/create', [App\Http\Controllers\SourceController::class, 'create'])->name('source.create');
Route::post('sources', [App\Http\Controllers\SourceController::class, 'store'])->name('source.store');
Route::patch('sources/{source}', [App\Http\Controllers\SourceController::class, 'update'])->name('source.update');
Route::delete('sources/{source}', [App\Http\Controllers\SourceController::class, 'destroy'])->name('source.destroy');

Route::get('commissions/edit', [App\Http\Controllers\CommissionController::class, 'edit'])->name('commissions.edit');
Route::patch('commissions/edit', [App\Http\Controllers\CommissionController::class, 'update'])->name('commissions.update');



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
