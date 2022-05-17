<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KoboceiController;
use App\Model\Cei;

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

//Dashboard routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//NFM 2 Dashboard get routes
Route::get('/prevdash', [App\Http\Controllers\PrevdashController::class, 'prevdash'])->name('prevdash');

//Cbo get routes
Route::get('/cbo', [App\Http\Controllers\CboController::class, 'cbo_index'])->name('cbo');
Route::get('/cbo_monthly', [App\Http\Controllers\CboController::class, 'cbo_monthly'])->name('cbo.monthly');
Route::get('/add_cbo/', [App\Http\Controllers\CboController::class, 'add_cbo_view'])->name('cbo.add.view');
Route::get('/cbo_monthly/view_more/{id}', [App\Http\Controllers\CboController::class, 'view_more'])->name('cbo.view_more');


//CBO Get FGD Routes
Route::get('/otherreports', [App\Http\Controllers\FgdreportController::class, 'index'])->name('fgdreport');
Route::get('/otherreports/view_more/{id}', [App\Http\Controllers\FgdreportController::class, 'view_more'])->name('fgdreport.view_more');

Route::post('/otherreports', [App\Http\Controllers\FgdreportController::class, 'add_fgd'])->name('fgdreport.add');
Route::post('/otherreports/delete/{id}', [App\Http\Controllers\FgdreportController::class, 'delete'])->name('fgdreport.delete');
Route::post('/otherreports/delete', [App\Http\Controllers\FgdreportController::class, 'multiple_delete'])->name('fgdreport.multiple_delete');

//Cbo post routes
Route::post('/cbo', [App\Http\Controllers\CboController::class, 'add_cbo'])->name('cbo.add');
Route::post('/cbo/cat_add', [App\Http\Controllers\CatController::class, 'add_cat'])->name('cat.add');
Route::post('/cbo/fetch', [App\Http\Controllers\CboController::class, 'fetch'])->name('lga.fetch');
Route::post('/cat/fetch', [App\Http\Controllers\CboController::class, 'cbo_fetch'])->name('cbo.fetch');
Route::post('/cbo_monthly/add', [App\Http\Controllers\CboController::class, 'add_cbo_monthly'])->name('cbo.add_monthly');
Route::post('/cbo_monthly/delete/{id}', [App\Http\Controllers\CboController::class, 'delete_cbo_monthly'])->name('cbo.delete_monthly');
Route::post('/cbo_monthly/delete', [App\Http\Controllers\CboController::class, 'multiple_delete'])->name('cbo.multiple_delete');

//Spo get routes
Route::get('/spo_add', [App\Http\Controllers\SpoController::class, 'spo_index'])->name('spo.monthly');
Route::get('/spo_monthly/', [App\Http\Controllers\SpoController::class, 'spo_monthly'])->name('spo_add_monthly');
Route::get('/spo_monthly/view_more/{id}', [App\Http\Controllers\SpoController::class, 'view_more'])->name('spo_monthly.view_more');

//Spo post routes
Route::post('/spo/add', [App\Http\Controllers\SpoController::class, 'add_spo'])->name('spo.add');
Route::post('/spo_monthly/add', [App\Http\Controllers\SpoController::class, 'add_spomonthly'])->name('spo.add_monthly');
Route::post('/spo_monthly/delete/{id}', [App\Http\Controllers\SpoController::class, 'delete'])->name('spo.delete_monthly');
Route::post('/spo_monthly/delete', [App\Http\Controllers\SpoController::class, 'multiple_delete'])->name('spo.multiple_delete');

//Remidial get routes
Route::get('/remidialfeedback', [App\Http\Controllers\RemidialController::class, 'remidial'])->name('remidial');
Route::get('/remidialfeedback/view_more/{id}', [App\Http\Controllers\RemidialController::class, 'view_more'])->name('remidial.view_more');

//Remidial post routes
Route::post('/remidialfeedback', [App\Http\Controllers\RemidialController::class, 'add_remidial'])->name('add_remidial');
Route::post('/remidialfeedback/delete/{id}', [App\Http\Controllers\RemidialController::class, 'delete'])->name('remedial.delete');
Route::post('/remidialfeedback/delete', [App\Http\Controllers\RemidialController::class, 'multiple_delete'])->name('remedial.multiple_delete');

//Health-facilities get routes
Route::get('/healthfacilities', [App\Http\Controllers\HealthFacilitiesController::class, 'health_facility'])->name('health_facility');

//Health-facilities post routes
Route::post('/healthfacilities/', [App\Http\Controllers\HealthFacilitiesController::class, 'health_facility_add'])->name('add_health_facility');
Route::post('/healthfacilities/fetch', [App\Http\Controllers\HealthFacilitiesController::class, 'fetch'])->name('healthfacilities.lga.fetch');
Route::post('/healthfacilities/cbo/fetch', [App\Http\Controllers\HealthFacilitiesController::class, 'cbo_fetch'])->name('healthfacilities.cbo.fetch');
Route::post('/healthfacilities/fetch_info', [App\Http\Controllers\HealthFacilitiesController::class, 'cbo_info'])->name('cbo_info');

//Client Exit get routes
Route::get('/clientexit', [App\Http\Controllers\ClientExitController::class, 'client_exit'])->name('client.exit');
Route::get('/clientexit/view_more/{id}', [App\Http\Controllers\ClientExitController::class, 'view_more'])->name('client.view_more');
Route::get('/clientexit/kobo-view/{id}', [App\Http\Controllers\ClientExitController::class, 'kobo_view_more'])->name('client.kobo_view_more');
Route::get('/koboceianalysis', [App\Http\Controllers\CeiAnalysisController::class, 'kobocei_analysis'])->name('backend.cei_analysis.kobocei_analysis');

// Route::get('/clientexit', [App\Http\Controllers\ClientExitController::class, 'client_exit'])->name('client.exit');

//Client Exit post routes
Route::post('/clientexit', [App\Http\Controllers\ClientExitController::class, 'client_exit_add'])->name('client_exit.add');
Route::post('/clientexit/delete/{id}', [App\Http\Controllers\ClientExitController::class, 'delete'])->name('client_exit.delete');
Route::post('/clientexit/delete', [App\Http\Controllers\ClientExitController::class, 'multiple_delete'])->name('client.delete_multiple');


//Wards get routes
Route::get('/wards', [App\Http\Controllers\WardsController::class, 'index'])->name('wards.view');

//Wards post routes
Route::post('/wards', [App\Http\Controllers\WardsController::class, 'add_ward'])->name('wards.add');

//Excel parse routes
Route::post('/cbo/excel', [App\Http\Controllers\ExcelImportController::class, 'uploadCbo'])->name('excel.cbo');
Route::post('/spo/excel', [App\Http\Controllers\ExcelImportController::class, 'uploadSpo'])->name('excel.spo');
Route::post('/healthfacility/excel', [App\Http\Controllers\ExcelImportController::class, 'uploadHealthFacility'])->name('excel.health');

//Analysis get routes
Route::get('/genanalysis', [App\Http\Controllers\GeneralAnalysisController::class, 'genanalysis'])->name('genanalysis');
Route::post('/genanalysis', [App\Http\Controllers\GeneralAnalysisController::class, 'fetchRecords'])->name('genanalysis.fetch');

//CEI Analysis get routes
Route::get('/cei_analysis', [App\Http\Controllers\CeiAnalysisController::class, 'cei_analysis_index'])->name('cei_analysis');
Route::get('/cei_analysis/table', [App\Http\Controllers\CeiAnalysisController::class, 'cei_analysis_table'])->name('cei_analysis.load');
Route::get('/cei-barchart', [App\Http\Controllers\CeiAnalysisController::class, 'barchart'])->name('cei_analysis.barchart');
Route::get('/cei/barchart', [App\Http\Controllers\CeiAnalysisController::class, 'getChart'])->name('cei_analysis.getbarchart');
Route::get('/kobo/barchart', [App\Http\Controllers\CeiAnalysisController::class, 'getkoboChart'])->name('cei_analysis.getkobobarchart');
Route::get('/ceimonthly', [App\Http\Controllers\CeiAnalysisController::class, 'cei_monthly'])->name('backend.cei_analysis.ceimonthly');
Route::get('/ceiquarterly', [App\Http\Controllers\CeiAnalysisController::class, 'cei_quarterly'])->name('backend.cei_analysis.ceiquarterly');

//
Route::get('/otherreportsanalysis', [App\Http\Controllers\FgdAnalysisController::class, 'otherreportsquarterly'])->name('backend.fgd.otherreports');


Route::post('/cei_analysis', [App\Http\Controllers\CeiAnalysisController::class, 'cei_analysis_fetch'])->name('cei_analysis.fetch');
Route::post('/cei_analysis/table', [App\Http\Controllers\CeiAnalysisController::class, 'cei_analysis_table'])->name('cei_analysis.table');
Route::post('/kobo_analysis/table', [App\Http\Controllers\CeiAnalysisController::class, 'kobo_analysis_table'])->name('kobo_analysis.table');

//file display
Route::get('image/{filename}', [App\Http\Controllers\ImageController::class, 'displayImage'])->name('displayImage');
