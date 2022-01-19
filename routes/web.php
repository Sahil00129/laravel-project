<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MonthlygetDataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportsDataController;
use App\Http\Controllers\CompanySetupController;
use App\Http\Controllers\SampledownloadController;
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
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('submit-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('submit-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/imports', [ImportsDataController::class, 'index'])->name('imports');
Route::get('/customers', [HomeController::class, 'customers']);
Route::get('/monthly', [MonthlygetDataController::class, 'index']);
Route::get('/getpdf', [HomeController::class, 'getPdf']);
//Route::get('/invoicepdf', [HomeController::class, 'singlePdf']);
Route::get('/invoicepdf',[MonthlygetDataController::class,'singlePDF']);
Route::get('/current-month', [ImportsDataController::class, 'currentMonth']);
Route::any('/company-setup', [CompanySetupController::class, 'companySetup']);
Route::any('/company-setup/fetch', [CompanySetupController::class,'fetchData']);
Route::any('/company-setup/edit{id}', [CompanySetupController::class,'editCompany']);

Route::any('/updateUser', [CompanySetupController::class,'updateCmpny']);
Route::get('delete/{id}',[CompanySetupController::class, 'deleteData']);
//Route::any('delete/{id}', [CompanySetupController::class,'destroy']);



Route::post('/imports', [ImportsDataController::class, 'importData'])->name('imports');

Route::get('/customers', [MonthlygetDataController::class, 'fetchData']);

Route::any('/getdata', [MonthlygetDataController::class, 'getData']);    //monthly getdata 

Route::any('/get-pdf',[MonthlygetDataController::class,'getPDF']);       //all invoice pdf

Route::any('/invoice-pdf',[MonthlygetDataController::class,'invoicePDF']);      //single pdf

Route::any('/upload-csv', [ImportsDataController::class, 'uploadCSV']);         //ajax import

Route::any('/save-company', [CompanySetupController::class, 'cmpySet']);

Route::any('/upload-Masters', [ImportsDataController::class, 'uploadMasters']);  // for masters
 
Route::get('/sample-master',[SampledownloadController::class, 'sampleMaster']);
Route::get('/sample-opening',[SampledownloadController::class, 'sampleOpening']);
Route::get('/sample-current',[SampledownloadController::class, 'sampleCurrent']);

Route::get('edit-company/{id}', [CompanySetupController::class, 'edit']);

Route::put('updated-company', [CompanySetupController::class, 'update']);