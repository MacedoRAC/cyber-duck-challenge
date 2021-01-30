<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyEmployeeController;
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

Auth::routes([
    'register' => false
]);

Route::redirect('/', '/companies');
Route::redirect('/home', '/companies')->name('home');

Route::resources([
    'companies' => CompanyController::class,
    'companies.employees' => CompanyEmployeeController::class
]);
