<?php

use App\Http\Livewire\Companies\Index as CompaniesIndex;
use App\Http\Livewire\Employees\Index as EmployeesIndex;
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
    return view('index');
})->name('home');

Route::get('/companies', CompaniesIndex::class)->name('companies.index');
Route::get('/companies/{company}/employees', EmployeesIndex::class)->name('employees.index');
