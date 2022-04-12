<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\caseController;

use App\Http\Controllers\bagAndTagController;
use App\Http\Controllers\evidenceIdentification;
use App\Http\Controllers\labInvestigationController;
use App\Http\Controllers\initialEvidenceStateController;
use App\Http\Controllers\storageAlterationController;
use App\Http\Controllers\evidenceHandler;
use App\Http\Controllers\pdfBuilderController;
use App\Http\Controllers\twoFactorAuth;
use App\Http\Controllers\Login_Controller;
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
    return view('/auth/login');
});

Route::get('/dashboard', function () { return view('/case-and-notes-views.dashboard');})->name('dashboard')->middleware('auth', 'checkLoginVerified: 1');


Route::get('/case/{caseName}', [caseController::class, 'index'])->name('showNotes')->middleware('auth', 'checkLoginVerified: 1');

Route::get('/case/{caseName}/new-note/bag-and-tag', [bagAndTagController::class, 'create'])->name('load_BagAndTag_Form')->middleware('auth', 'checkLoginVerified: 1');
Route::get('/case/{caseName}/new-note/evidence-identification', [evidenceIdentification::class, 'create'])->name('load_evidenceIdentification_Form')->middleware('auth', 'checkLoginVerified: 1');
Route::get('/case/{case_name}/new-note/lab-investigation', [labInvestigationController::class, 'create'])->name('load_LabInvestigation_Form')->middleware('auth', 'checkLoginVerified: 1');
Route::get('/case/{case_name}/new-note/initial-evidence-state', [initialEvidenceStateController::class, 'create'])->name('load_InitialEvidenceState_Form')->middleware('auth', 'checkLoginVerified: 1');
Route::get('/case/{case_name}/new-note/change-case-status', [caseController::class, 'change_status'])->name('load_ChangeCaseStatus_Form')->middleware('auth', 'checkLoginVerified: 1');
Route::get('/case/{case_name}/new-note/storage-alteration', [storageAlterationController::class, 'create'])->name('load_storage_alteration_Form')->middleware('auth', 'checkLoginVerified: 1');


Route::get('/case/{companyName}/new-case/create-case', [caseController::class, 'create'])->name('load_create_new_case_Form')->middleware('auth', 'checkLoginVerified: 1');
Route::get('/case/{caseName}/evidence-items', [evidenceHandler::class, 'index'])->name('load_create_new_case_Form')->middleware('auth', 'checkLoginVerified: 1');


Route::post('/case/{case_name}/submit-note/bag-and-tag', [bagAndTagController::class, 'store'])->name('submit_bag_and_tag_note')->middleware('auth', 'checkLoginVerified: 1');
Route::post('/case/{case_name}/submit-note/evidence-identification', [evidenceIdentification::class, 'store'])->name('submit_evidence_identification_note')->middleware('auth', 'checkLoginVerified: 1');
Route::post('/case/{case_name}/submit-note/storage-alteration', [storageAlterationController::class, 'store'])->name('submit_storage_alteration_note')->middleware('auth', 'checkLoginVerified: 1');
Route::post('/case/{case_name}/submit-note/lab-investigation', [labInvestigationController::class, 'store'])->name('submit_lab_investigation_note')->middleware('auth', 'checkLoginVerified: 1');
Route::post('/case/{case_name}/submit-note/initial-evidence-state', [initialEvidenceStateController::class, 'store'])->name('submit_initial_evidence_state_note')->middleware('auth', 'checkLoginVerified: 1');
Route::post('/case/{case_name}/submit-note/case-status', [caseController::class, 'update'])->name('submit_change_case_status_note')->middleware('auth', 'checkLoginVerified: 1');

Route::post('/{companie_name}/case/create-case', [caseController::class, 'store'])->name('submit_submit_case_note')->middleware('auth', 'checkLoginVerified: 1');

Route::get('/case/{caseName}/notes/table-view', [evidenceHandler::class, 'table_view_index'])->name('show_notes_table_view')->middleware('auth', 'checkLoginVerified: 1');
Route::get('/case/{caseName}/notes/timeline-view', [evidenceHandler::class, 'timeline_view_index'])->name('show_notes_timeline_view')->middleware('auth', 'checkLoginVerified: 1');
Route::get('/case/{caseName}/hex-interpreter', [evidenceHandler::class, 'hex_interpreter'])->name('show_file_hex')->middleware('auth', 'checkLoginVerified: 1');

Route::post('/case/{caseName}/hex-interpreter/get-content', [evidenceHandler::class, 'get_hex_content'])->name('show_file_hex2')->middleware('auth', 'checkLoginVerified: 1');

Route::get('/case/{caseName}/create-pdf', [pdfBuilderController::class, 'createPDF'])->name('create_pdf')->middleware('auth', 'checkLoginVerified: 1');

Route::get('/case/{case_name}/case-closed/view-notes', [evidenceHandler::class, 'final_Notes_View'])->name('case-closed-view-notes')->middleware('auth', 'checkLoginVerified: 1');

Route::get('/send-auth-token', [twoFactorAuth::class, 'index'])->name('create_auth_code');
Route::post('/check-auth-code', [twoFactorAuth::class, 'check'])->name('check_auth_code');
Route::get('logout', '\App\Http\Controllers\Login_Controller@logout');

require __DIR__.'/auth.php';
