<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImportExcelController;
use App\Components\Topics\Save;
use App\Components\Results\Read;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::post('score',[UserController::class,'getData']);
Route::post('att',[UserController::class,'getAtt']);

Route::post('topics',[Save::class,'store'])->name('summernotePersist');

Route::post('position',[Read::class,'corr'])->name('termposition');


//uploads

// Route for view/blade file.
// Route::get('importExportView', [ExcelController::class, 'importExportView'])->name('importExportView');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('exportExcel/{type}', [ImportExcelController::class, 'exportExcel'])->name('exportExcel');

Route::get('/import',[ImportExcelController::class,'importExportView'])->name('importExportView');
Route::post('/importExcel', [ImportExcelController::class, 'importExcel'])->name('importExcel');

// Route::get('/updateapp', function()
// {
//     exec('composer dump-autoload');
//     echo 'composer dump-autoload complete';
// });
Route::get('/clear', function() {
// dd('hi');
//   \Artisan::call('cache:clear');
//   \Artisan::call('config:clear');
//   \Artisan::call('config:cache');
//   \Artisan::call('view:clear');

   return "Cleared!";

});


// Route::get('/website','../website')->name('website');