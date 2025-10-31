<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuditController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\users\UsersController;
use App\Http\Controllers\admin\ManualController;
use App\Http\Controllers\admin\TrainingController;
use App\Http\Controllers\users\ApprovalController;
use App\Http\Controllers\auditee\AuditeeController;
use App\Http\Controllers\auditor\AuditorController;
use App\Http\Controllers\users\ActivationController;
use App\Http\Controllers\director\DirectorController;
use App\Http\Controllers\admin\QualityAuditorController;
use App\Http\Controllers\admin\RampInspectionController;
use App\Http\Controllers\Auditee\AuditeeAuditController;
use App\Http\Controllers\auditor\AuditorAuditController;
use App\Http\Controllers\admin\TrainingRecordSaController;
use App\Http\Controllers\Director\DirectorAuditController;
use App\Http\Controllers\admin\AuthorizedAuditorController;
use App\Http\Controllers\admin\TrainingRecordSESController;
use App\Http\Controllers\Auditee\AuditeeTrainingController;
use App\Http\Controllers\auditor\AuditorTrainingController;
use App\Http\Controllers\admin\QualifyingMechanicController;
use App\Http\Controllers\Director\DirectorTrainingController;
use App\Http\Controllers\admin\StoreQualityInspectorController;
use App\Http\Controllers\admin\AircraftCertifyingStaffController;
use App\Http\Controllers\Auditee\AuditeeQualityAuditorController;
use App\Http\Controllers\Auditee\AuditeeRampInspectionController;
use App\Http\Controllers\auditor\AuditorQualityAuditorController;
use App\Http\Controllers\auditor\AuditorRampInspectionController;
use App\Http\Controllers\admin\ComponentCertifyingStaffController;
use App\Http\Controllers\Auditee\AuditeeTrainingRecordSaController;
use App\Http\Controllers\auditor\AuditorTrainingRecordSaController;
use App\Http\Controllers\Director\DirectorQualityAuditorController;
use App\Http\Controllers\director\DirectorRampInspectionController;
use App\Http\Controllers\Auditee\AuditeeAuthorizedAuditorController;
use App\Http\Controllers\Auditee\AuditeeTrainingRecordSESController;
use App\Http\Controllers\auditor\AuditorAuthorizedAuditorController;
use App\Http\Controllers\auditor\AuditorTrainingRecordSESController;
use App\Http\Controllers\Auditee\AuditeeQualifyingMechanicController;
use App\Http\Controllers\auditor\AuditorQualifyingMechanicController;
use App\Http\Controllers\Director\DirectorTrainingRecordSaController;
use App\Http\Controllers\Director\DirectorAuthorizedAuditorController;
use App\Http\Controllers\Director\DirectorTrainingRecordSESController;
use App\Http\Controllers\Director\DirectorQualifyingMechanicController;
use App\Http\Controllers\admin\AuthorizedStandardLabPersonnelController;
use App\Http\Controllers\Auditee\AuditeeStoreQualityInspectorController;
use App\Http\Controllers\auditor\AuditorStoreQualityInspectorController;
use App\Http\Controllers\Auditee\AuditeeAircraftCertifyingStaffController;
use App\Http\Controllers\auditor\AuditorAircraftCertifyingStaffController;
use App\Http\Controllers\Director\DirectorStoreQualityInspectorController;
use App\Http\Controllers\Auditee\AuditeeComponentCertifyingStaffController;
use App\Http\Controllers\auditor\AuditorComponentCertifyingStaffController;
use App\Http\Controllers\Director\DirectorAircraftCertifyingStaffController;
use App\Http\Controllers\Director\DirectorComponentCertifyingStaffController;
use App\Http\Controllers\Auditee\AuditeeAuthorizedStandardLabPersonnelController;
use App\Http\Controllers\auditor\AuditorAuthorizedStandardLabPersonnelController;
use App\Http\Controllers\Director\DirectorAuthorizedStandardLabPersonnelController;





//=============login======================================================================================

Route::get('/', [LoginController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'login'])->name('login');


// //=============logout=====================================================================================

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');





//============= Admin Routes =========================================================================

//============= Dashboard =========================================================================

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('Admin');




//============= Users =========================================================================

Route::get('/admin/users/view', [UsersController::class, 'users'])->name('admin.users.view')->middleware('Admin');

Route::get('/admin/users/form', [UsersController::class, 'usersform'])->name('admin.users.usersform')->middleware('Admin');

Route::post('/admin/users/form/create', [UsersController::class, 'create'])->name('admin.users.usersform.create')->middleware('Admin');

Route::get('/admin/users/singleView/{id}', [UsersController::class, 'single'])->name('admin.users.single')->middleware('Admin');

Route::get('/admin/users/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit')->middleware('Admin');

Route::post('/admin/users/upate/{id}', [UsersController::class, 'update'])->name('admin.users.update')->middleware('Admin');

Route::get('/admin/users/delete/{id}', [UsersController::class, 'delete'])->name('admin.users.delete')->middleware('Admin');


// =================== Import Users =======================================

Route::post('/admin/users/import', [UsersController::class, 'import'])
    ->name('admin.users.import')
    ->middleware('Admin');


// =================== Export Users =======================================

Route::get('/admin/users/export', [UsersController::class, 'export'])
    ->name('admin.users.export')
    ->middleware('Admin');


// ========= Active, Deactive, Approve, Dis-approve ===========================================

Route::post('/admin/users/approve/{id}', [ApprovalController::class, 'approve'])->name('admin.users.approve')->middleware('Admin');

Route::post('/admin/users/disapprove/{id}', [ApprovalController::class, 'disapprove'])->name('admin.users.disapprove')->middleware('Admin');

Route::post('/admin/users/active/{id}', [ActivationController::class, 'active'])->name('admin.users.active')->middleware('Admin');

Route::post('/admin/users/deactive/{id}', [ActivationController::class, 'deactive'])->name('admin.users.deactive')->middleware('Admin');



// ========= Manuals ===========================================

Route::get('/admin/document/manual/view', [ManualController::class, 'view'])->name('admin.document.manual.view')->middleware('Admin');

Route::get('/admin/document/manual/form', [ManualController::class, 'form'])->name('admin.document.manual.form')->middleware('Admin');

Route::post('/admin/document/manual/create', [ManualController::class, 'create'])->name('admin.document.manual.create')->middleware('Admin');

Route::get('/admin/document/manual/edit/{id}', [ManualController::class, 'edit'])->name('admin.document.manual.edit')->middleware('Admin');

Route::post('/admin/document/manual/update/{id}', [ManualController::class, 'update'])->name('admin.document.manual.update')->middleware('Admin');

Route::get('/admin/document/manual/delete/{id}', [ManualController::class, 'delete'])->name('admin.document.manual.delete')->middleware('Admin');




// ========= Ramp Inspection ===========================================

Route::get('/admin/rampinspection/view', [RampInspectionController::class, 'view'])->name('admin.rampinspection.view')->middleware('Admin');

// View only Open findings
Route::get('/admin/rampinspection/finding/view/open/{id}', [RampInspectionController::class, 'findingViewOpen'])
    ->name('admin.rampinspection.finding.view.open')
    ->middleware('Admin');

// View only Closed findings
Route::get('/admin/rampinspection/finding/view/close/{id}', [RampInspectionController::class, 'findingViewClose'])
    ->name('admin.rampinspection.finding.view.close')
    ->middleware('Admin');

Route::get('/admin/rampinspection/form', [RampInspectionController::class, 'form'])->name('admin.rampinspection.form')->middleware('Admin');

Route::post('/admin/rampinspection/create', [RampInspectionController::class, 'create'])->name('admin.rampinspection.create')->middleware('Admin');

Route::get('/admin/rampinspection/edit/{id}', [RampInspectionController::class, 'edit'])->name('admin.rampinspection.edit')->middleware('Admin');

Route::post('/admin/rampinspection/update/{id}', [RampInspectionController::class, 'update'])->name('admin.rampinspection.update')->middleware('Admin');

Route::get('/admin/rampinspection/delete/{id}', [RampInspectionController::class, 'delete'])->name('admin.rampinspection.delete')->middleware('Admin');


// Print & Download Ramp Inspection PDF
Route::get('/admin/rampinspection/print/pdf/{id}', [RampInspectionController::class, 'generatePdf'])
    ->name('admin.rampinspection.print.pdf')
    ->middleware('Admin');

Route::get('/admin/rampinspection/download/pdf/{id}', [RampInspectionController::class, 'downloadPdf'])
    ->name('admin.rampinspection.download.pdf')
    ->middleware('Admin');

// RampInspection PDF Export by Date Range
Route::get('/admin/rampinspection/export/pdf', [RampInspectionController::class, 'exportRampInspectionsByDate'])
    ->name('admin.rampinspection.range.pdf')
    ->middleware('Admin');


// Excel Import
Route::post('/admin/rampinspection/import', [RampInspectionController::class, 'importExcel'])
    ->name('admin.rampinspection.import')
    ->middleware('Admin');

// Excel Export (date range)
Route::get('/admin/rampinspection/export/excel', [RampInspectionController::class, 'exportExcelByDate'])
    ->name('admin.rampinspection.range.excel')
    ->middleware('Admin');













// ========= Ramp Inspection Findings ===========================================

Route::get('/admin/rampinspection/finding/view/{id}', [RampInspectionController::class, 'findingView'])->name('admin.rampinspection.finding.view')->middleware('Admin');

Route::get('/admin/rampinspection/finding/form/{id}', [RampInspectionController::class, 'findingForm'])->name('admin.rampinspection.finding.form')->middleware('Admin');

Route::post('/admin/rampinspection/finding/create', [RampInspectionController::class, 'findingCreate'])->name('admin.rampinspection.finding.create')->middleware('Admin');

Route::get('/admin/rampinspection/finding/edit/{id}', [RampInspectionController::class, 'findingEdit'])->name('admin.rampinspection.finding.edit')->middleware('Admin');

Route::post('/admin/rampinspection/finding/update/{id}', [RampInspectionController::class, 'findingUpdate'])->name('admin.rampinspection.finding.update')->middleware('Admin');

Route::get('/admin/rampinspection/finding/delete/{id}', [RampInspectionController::class, 'findingDelete'])->name('admin.rampinspection.finding.delete')->middleware('Admin');


// Print & Download Ramp Inspection Finding

Route::get('/admin/rampinspection/finding/print/pdf/{id}', [RampInspectionController::class, 'printRampFinding'])
    ->name('admin.rampinspection.finding.print.pdf')
    ->middleware('Admin');

Route::get('/admin/rampinspection/finding/download/pdf/{id}', [RampInspectionController::class, 'downloadRampFinding'])
    ->name('admin.rampinspection.finding.download.pdf')
    ->middleware('Admin');


// Export all findings by date range

Route::get('/admin/rampinspection/{ramp}/finding/export/pdf', [RampInspectionController::class, 'exportRampFindingsByDateRange'])
    ->name('admin.rampinspection.finding.range.pdf')
    ->middleware('Admin');


// Finding Excel Import
Route::post('/admin/rampinspection/{ramp}/finding/import', [RampInspectionController::class, 'importRampFindings'])
    ->name('admin.rampinspection.finding.import')
    ->middleware('Admin');


// Finding Excel Export by Date Range
Route::get('/admin/rampinspection/{ramp}/finding/export/excel', [RampInspectionController::class, 'exportRampFindingsExcelByDateRange'])
    ->name('admin.rampinspection.finding.range.excel')
    ->middleware('Admin');

// routes/web.php
Route::post('/admin/rampinspection/finding/{finding}/send-email', [RampInspectionController::class, 'sendFindingEmail'])
    ->name('admin.rampinspection.finding.sendEmail')
    ->middleware('Admin');










// ========= Ramp Inspection Reply ===========================================

Route::get('/admin/rampinspection/finding/reply/view/{id}', [RampInspectionController::class, 'replyView'])->name('admin.rampinspection.finding.reply.view')->middleware('Admin');

Route::get('/admin/rampinspection/finding/reply/form/{id}', [RampInspectionController::class, 'replyForm'])->name('admin.rampinspection.finding.reply.form')->middleware('Admin');

Route::post('/admin/rampinspection/finding/reply/create', [RampInspectionController::class, 'replyCreate'])->name('admin.rampinspection.finding.reply.create')->middleware('Admin');

Route::get('/admin/rampinspection/finding/reply/edit/{id}', [RampInspectionController::class, 'replyEdit'])->name('admin.rampinspection.finding.reply.edit')->middleware('Admin');

Route::post('/admin/rampinspection/finding/reply/update/{id}', [RampInspectionController::class, 'replyUpdate'])->name('admin.rampinspection.finding.reply.update')->middleware('Admin');

Route::get('/admin/rampinspection/finding/reply/delete/{id}', [RampInspectionController::class, 'replyDelete'])->name('admin.rampinspection.finding.reply.delete')->middleware('Admin');


// Print & Download RampInspection Finding Reply
Route::get('/admin/rampinspection/finding/reply/print/{id}', [RampInspectionController::class, 'printRampReplies'])
    ->name('admin.rampinspection.finding.reply.print.pdf')->middleware('Admin');

Route::get('/admin/rampinspection/finding/reply/download/{id}', [RampInspectionController::class, 'downloadRampReplies'])
    ->name('admin.rampinspection.finding.reply.download.pdf')->middleware('Admin');

Route::get('/admin/rampinspection/finding/{finding}/reply/export/pdf', [RampInspectionController::class, 'exportRepliesOfRampFindingByDateRange'])
    ->name('admin.rampinspection.finding.reply.range.pdf')
    ->middleware('Admin');

// Reply Excel Import
Route::post('/admin/rampinspection/finding/reply/import/{finding}', [RampInspectionController::class, 'importRampReplies'])
    ->name('admin.rampinspection.finding.reply.import')->middleware('Admin');

// Reply Excel Export with Date Range
Route::get('/admin/rampinspection/finding/{finding}/reply/export/excel', [RampInspectionController::class, 'exportRampRepliesExcelByDateRange'])
    ->name('admin.rampinspection.finding.reply.export.excel')->middleware('Admin');
















// ========= Audit ===========================================

Route::get('/admin/audit/view', [AuditController::class, 'view'])->name('admin.audit.view')->middleware('Admin');

Route::get('/admin/audit/form', [AuditController::class, 'form'])->name('admin.audit.form')->middleware('Admin');

Route::post('/admin/audit/create', [AuditController::class, 'create'])->name('admin.audit.create')->middleware('Admin');

Route::get('/admin/audit/edit/{id}', [AuditController::class, 'edit'])->name('admin.audit.edit')->middleware('Admin');

Route::post('/admin/audit/update/{id}', [AuditController::class, 'update'])->name('admin.audit.update')->middleware('Admin');

Route::get('/admin/audit/delete/{id}', [AuditController::class, 'delete'])->name('admin.audit.delete')->middleware('Admin');


// ========= Print & Download ===========================================

Route::get('/admin/audit/print/pdf/{id}', [AuditController::class, 'generatePdf'])->name('admin.audit.print.pdf')->middleware('Admin');

Route::get('/admin/audit/download/pdf/{id}', [AuditController::class, 'downloadPdf'])->name('admin.audit.download.pdf')->middleware('Admin');

// Audit PDF for date range
Route::get('/admin/audit/export/pdf', [AuditController::class, 'exportAuditsByDate'])->name('admin.audit.range.pdf')->middleware('Admin');


// Audit Excel Import & Export
Route::post('/admin/audit/import', [AuditController::class, 'import'])->name('admin.audit.import')->middleware('Admin');

Route::get('/admin/audit/export/excel', [AuditController::class, 'exportExcelByDate'])->name('admin.audit.range.excel')->middleware('Admin');








// ========= Audit Findings ===========================================

Route::get('/admin/audit/finding/view/{id}', [AuditController::class, 'findingView'])->name('admin.audit.finding.view')->middleware('Admin');

Route::get('/admin/audit/finding/view/{id}/open', [AuditController::class, 'findingViewOpen'])->name('admin.audit.finding.view.open')->middleware('Admin');

Route::get('/admin/audit/finding/view/{id}/close', [AuditController::class, 'findingViewClose'])->name('admin.audit.finding.view.close')->middleware('Admin');

Route::get('/admin/audit/finding/form/{id}', [AuditController::class, 'findingForm'])->name('admin.audit.finding.form')->middleware('Admin');

Route::post('/admin/audit/finding/create', [AuditController::class, 'findingCreate'])->name('admin.audit.finding.create')->middleware('Admin');

Route::get('/admin/audit/finding/edit/{id}', [AuditController::class, 'findingEdit'])->name('admin.audit.finding.edit')->middleware('Admin');

Route::post('/admin/audit/finding/update/{id}', [AuditController::class, 'findingUpdate'])->name('admin.audit.finding.update')->middleware('Admin');

Route::get('/admin/audit/finding/delete/{id}', [AuditController::class, 'findingDelete'])->name('admin.audit.finding.delete')->middleware('Admin');

// ========= Print & Download ===========================================

Route::get('/admin/audit/finding/print/pdf/{id}', [AuditController::class, 'printAuditFindings'])->name('admin.audit.finding.print.pdf')->middleware('Admin');

Route::get('/admin/audit/finding/download/pdf/{id}', [AuditController::class, 'downloadAuditFindings'])->name('admin.audit.finding.download.pdf')->middleware('Admin');

// Export all findings by date range

Route::get('/admin/audit/{audit}/finding/export/pdf', [AuditController::class, 'exportAuditFindingsByDateRange'])
    ->name('admin.audit.finding.range.pdf')
    ->middleware('Admin');

// Finding Excel Import & Export
Route::post('/admin/finding/import', [AuditController::class, 'importAuditFindings'])->name('admin.finding.import')->middleware('Admin');

Route::get(
    '/admin/audit/{auditId}/finding/export/excel',
    [AuditController::class, 'exportFindingsByDate']
)
    ->name('admin.finding.export.excel')
    ->middleware('Admin');


// Audit Finding Email
Route::post('/admin/audit/finding/{id}/send-email', [AuditController::class, 'sendFindingEmail'])
    ->name('admin.audit.finding.sendEmail')
    ->middleware('Admin');






// ========= Audit Reply ===========================================

Route::get('/admin/audit/finding/reply/view/{id}', [AuditController::class, 'replyView'])->name('admin.audit.finding.reply.view')->middleware('Admin');

Route::get('/admin/audit/finding/reply/form/{id}', [AuditController::class, 'replyForm'])->name('admin.audit.finding.reply.form')->middleware('Admin');

Route::post('/admin/audit/finding/reply/create', [AuditController::class, 'replyCreate'])->name('admin.audit.finding.reply.create')->middleware('Admin');

Route::get('/admin/audit/finding/reply/edit/{id}', [AuditController::class, 'replyEdit'])->name('admin.audit.finding.reply.edit')->middleware('Admin');

Route::post('/admin/audit/finding/reply/update/{id}', [AuditController::class, 'replyUpdate'])->name('admin.audit.finding.reply.update')->middleware('Admin');

Route::get('/admin/audit/finding/reply/delete/{id}', [AuditController::class, 'replyDelete'])->name('admin.audit.finding.reply.delete')->middleware('Admin');


// ========= Audit Finding Print/Download with Reply ============================

Route::get('/admin/audit/finding/reply/print/{id}', [AuditController::class, 'printAuditReplies'])
    ->name('admin.audit.finding.reply.print.pdf')->middleware('Admin');

Route::get('/admin/audit/finding/reply/download/{id}', [AuditController::class, 'downloadAuditReplies'])
    ->name('admin.audit.finding.reply.download.pdf')->middleware('Admin');

Route::get('/admin/finding/{finding}/reply/export/pdf', [AuditController::class, 'exportRepliesOfFindingByDateRange'])
    ->name('admin.finding.reply.range.pdf')
    ->middleware('Admin');

Route::post('/admin/finding/reply/import', [AuditController::class, 'importAuditReplies'])
    ->name('admin.reply.import')
    ->middleware('Admin');

Route::get('/admin/finding/{finding}/reply/export/excel', [AuditController::class, 'exportRepliesExcel'])
    ->name('admin.finding.reply.range.excel')
    ->middleware('Admin');











// =========================== Training & Auth ===========================================

// =========================== SES ===========================================

// ========= Staff ===========================================

Route::get('/admin/training/view', [TrainingController::class, 'view'])->name('admin.training.view')->middleware('Admin');

Route::get('/admin/staff/form', [TrainingController::class, 'form'])->name('admin.staff.form')->middleware('Admin');

Route::post('/admin/staff/create', [TrainingController::class, 'create'])->name('admin.staff.create')->middleware('Admin');

Route::get('/admin/staff/edit/{id}', [TrainingController::class, 'edit'])->name('admin.staff.edit')->middleware('Admin');

Route::put('/admin/staff/update/{id}', [TrainingController::class, 'update'])->name('admin.staff.update')->middleware('Admin');

Route::get('/admin/staff/delete/{id}', [TrainingController::class, 'delete'])->name('admin.staff.delete')->middleware('Admin');

// =================== Export ====================================================

Route::get('/admin/staff/export', [TrainingController::class, 'export'])
    ->name('admin.staff.export')
    ->middleware('Admin');

// =================== Import ====================================================

Route::post('/admin/staff/import', [TrainingController::class, 'import'])->name('admin.staff.import')->middleware('Admin');




// ========= Aircraft Certifying Staff ===========================================

Route::get('admin/aircraft-certifying-staff/create', [AircraftCertifyingStaffController::class, 'create'])
    ->name('admin.aircraft.create')
    ->middleware('Admin');

Route::post('admin/aircraft-certifying-staff/store', [AircraftCertifyingStaffController::class, 'store'])
    ->name('admin.aircraft.store')
    ->middleware('Admin');

Route::get('admin/aircraft-certifying-staff/{id}/edit', [AircraftCertifyingStaffController::class, 'edit'])
    ->name('admin.aircraft.edit')
    ->middleware('Admin');

Route::put('admin/aircraft-certifying-staff/{id}', [AircraftCertifyingStaffController::class, 'update'])
    ->name('admin.aircraft.update')
    ->middleware('Admin');

Route::delete('admin/aircraft-certifying-staff/{id}', [AircraftCertifyingStaffController::class, 'delete'])
    ->name('admin.aircraft.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/aircraft-certifying-staff/{id}', [AircraftCertifyingStaffController::class, 'show'])
    ->name('admin.training.acs.single')
    ->middleware('Admin');

// ========= Print & Download ===========================================

Route::get('admin/aircraft-certifying-staff/{id}/print', [AircraftCertifyingStaffController::class, 'print'])
    ->name('admin.aircraft.print')
    ->middleware('Admin');

Route::get('admin/aircraft-certifying-staff/{id}/download', [AircraftCertifyingStaffController::class, 'download'])
    ->name('admin.aircraft.download')
    ->middleware('Admin');


// ========= Import Aircraft Certifying Staff ===========================================
Route::post('admin/aircraft-certifying-staff/import', [AircraftCertifyingStaffController::class, 'import'])
    ->name('admin.aircraft.import')
    ->middleware('Admin');


// ========= Component Certifying Staff ===========================================

Route::get('admin/component-certifying-staff/create', [ComponentCertifyingStaffController::class, 'create'])
    ->name('admin.component.create')
    ->middleware('Admin');

Route::post('admin/component-certifying-staff/store', [ComponentCertifyingStaffController::class, 'store'])
    ->name('admin.component.store')
    ->middleware('Admin');

Route::get('admin/component-certifying-staff/{id}/edit', [ComponentCertifyingStaffController::class, 'edit'])
    ->name('admin.component.edit')
    ->middleware('Admin');

Route::put('admin/component-certifying-staff/{id}', [ComponentCertifyingStaffController::class, 'update'])
    ->name('admin.component.update')
    ->middleware('Admin');

Route::delete('admin/component-certifying-staff/{id}', [ComponentCertifyingStaffController::class, 'delete'])
    ->name('admin.component.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/component-certifying-staff/{id}', [ComponentCertifyingStaffController::class, 'show'])
    ->name('admin.training.ccs.single')
    ->middleware('Admin');

// ========= Print & Download ===========================================

Route::get('admin/component-certifying-staff/{id}/print', [ComponentCertifyingStaffController::class, 'print'])
    ->name('admin.component.print')
    ->middleware('Admin');

Route::get('admin/component-certifying-staff/{id}/download', [ComponentCertifyingStaffController::class, 'download'])
    ->name('admin.component.download')
    ->middleware('Admin');


// ==================== Import ===========================================

Route::post('admin/component-certifying-staff/import', [ComponentCertifyingStaffController::class, 'import'])
    ->name('admin.component.import')
    ->middleware('Admin');




// ========= Quality Auditors ===========================================

Route::get('admin/quality-auditor/create', [QualityAuditorController::class, 'create'])
    ->name('admin.quality.create')
    ->middleware('Admin');

Route::post('admin/quality-auditor/store', [QualityAuditorController::class, 'store'])
    ->name('admin.quality.store')
    ->middleware('Admin');

Route::get('admin/quality-auditor/{id}/edit', [QualityAuditorController::class, 'edit'])
    ->name('admin.quality.edit')
    ->middleware('Admin');

Route::put('admin/quality-auditor/{id}', [QualityAuditorController::class, 'update'])
    ->name('admin.quality.update')
    ->middleware('Admin');

Route::delete('admin/quality-auditor/{id}', [QualityAuditorController::class, 'delete'])
    ->name('admin.quality.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/quality-auditor/{id}', [QualityAuditorController::class, 'show'])
    ->name('admin.training.quality.single')
    ->middleware('Admin');


// ========= Print & Download ===========================================

Route::get('admin/quality-auditor/{id}/print', [QualityAuditorController::class, 'print'])
    ->name('admin.quality.print')
    ->middleware('Admin');

Route::get('admin/quality-auditor/{id}/download', [QualityAuditorController::class, 'download'])
    ->name('admin.quality.download')
    ->middleware('Admin');

//========== Import Quality Auditor =====================================
Route::post('admin/quality-auditor/import', [QualityAuditorController::class, 'import'])
    ->name('admin.quality.import')
    ->middleware('Admin');




// ========= Qualifying Mechanics ===========================================

Route::get('admin/qualifying-mechanics/create', [QualifyingMechanicController::class, 'create'])
    ->name('admin.qualifiedmechanic.create')
    ->middleware('Admin');

Route::post('admin/qualifying-mechanics/store', [QualifyingMechanicController::class, 'store'])
    ->name('admin.qualifiedmechanic.store')
    ->middleware('Admin');

Route::get('admin/qualifying-mechanics/{id}/edit', [QualifyingMechanicController::class, 'edit'])
    ->name('admin.qualifiedmechanic.edit')
    ->middleware('Admin');

Route::put('admin/qualifying-mechanics/{id}', [QualifyingMechanicController::class, 'update'])
    ->name('admin.qualifiedmechanic.update')
    ->middleware('Admin');

Route::delete('admin/qualifying-mechanics/{id}', [QualifyingMechanicController::class, 'delete'])
    ->name('admin.qualifiedmechanic.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/qualifying-mechanics/{id}', [QualifyingMechanicController::class, 'show'])
    ->name('admin.training.qm.single')
    ->middleware('Admin');


// ========= Print & Download ===========================================

Route::get('admin/qualifying-mechanics/{id}/print', [QualifyingMechanicController::class, 'print'])
    ->name('admin.qm.print')
    ->middleware('Admin');

Route::get('admin/qualifying-mechanics/{id}/download', [QualifyingMechanicController::class, 'download'])
    ->name('admin.qm.download')
    ->middleware('Admin');

// ========= Import ===========================================

Route::post('admin/qualifying-mechanics/import', [QualifyingMechanicController::class, 'import'])
    ->name('admin.qm.import')
    ->middleware('Admin');



// ========= Store Quality Inspectors ===========================================

Route::get('admin/store-inspector/create', [StoreQualityInspectorController::class, 'create'])
    ->name('admin.store_inspector.create')
    ->middleware('Admin');

Route::post('admin/store-inspector/store', [StoreQualityInspectorController::class, 'store'])
    ->name('admin.store_inspector.store')
    ->middleware('Admin');

Route::get('admin/store-inspector/{id}/edit', [StoreQualityInspectorController::class, 'edit'])
    ->name('admin.store_inspector.edit')
    ->middleware('Admin');

Route::put('admin/store-inspector/{id}', [StoreQualityInspectorController::class, 'update'])
    ->name('admin.store_inspector.update')
    ->middleware('Admin');

Route::delete('admin/store-inspector/{id}', [StoreQualityInspectorController::class, 'delete'])
    ->name('admin.store_inspector.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/store-inspector/{id}', [StoreQualityInspectorController::class, 'show'])
    ->name('admin.training.store_inspector.single')
    ->middleware('Admin');

// ========= Print & Download for Store Quality Inspectors ==========
Route::get('admin/store-quality-inspectors/{id}/print', [StoreQualityInspectorController::class, 'print'])
    ->name('admin.storeinspector.print')
    ->middleware('Admin');

Route::get('admin/store-quality-inspectors/{id}/download', [StoreQualityInspectorController::class, 'download'])
    ->name('admin.storeinspector.download')
    ->middleware('Admin');

// ========= Import ===========================================

Route::post('admin/store-quality-inspectors/import', [StoreQualityInspectorController::class, 'import'])
    ->name('admin.storeinspector.import')
    ->middleware('Admin');




// ========= Authorized Standard Lab Personnel ===========================================

Route::get('admin/standard-lab/create', [AuthorizedStandardLabPersonnelController::class, 'create'])
    ->name('admin.standard_lab.create')
    ->middleware('Admin');

Route::post('admin/standard-lab/store', [AuthorizedStandardLabPersonnelController::class, 'store'])
    ->name('admin.standard_lab.store')
    ->middleware('Admin');

Route::get('admin/standard-lab/{id}/edit', [AuthorizedStandardLabPersonnelController::class, 'edit'])
    ->name('admin.standard_lab.edit')
    ->middleware('Admin');

Route::put('admin/standard-lab/{id}', [AuthorizedStandardLabPersonnelController::class, 'update'])
    ->name('admin.standard_lab.update')
    ->middleware('Admin');

Route::delete('admin/standard-lab/{id}', [AuthorizedStandardLabPersonnelController::class, 'delete'])
    ->name('admin.standard_lab.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/standard-lab/{id}', [AuthorizedStandardLabPersonnelController::class, 'show'])
    ->name('admin.training.standard_lab.single')
    ->middleware('Admin');

// ========= Print & Download ===========================================

Route::get('admin/standard-lab/{id}/print', [AuthorizedStandardLabPersonnelController::class, 'print'])
    ->name('admin.standard_lab.print')
    ->middleware('Admin');

Route::get('admin/standard-lab/{id}/download', [AuthorizedStandardLabPersonnelController::class, 'download'])
    ->name('admin.standard_lab.download')
    ->middleware('Admin');

// ========= Import =====================================================

Route::post('admin/standard-lab/import', [AuthorizedStandardLabPersonnelController::class, 'import'])
    ->name('admin.standard_lab.import')
    ->middleware('Admin');



// ========= Training Record SES ===========================================

Route::get('admin/training-ses/create', [TrainingRecordSESController::class, 'create'])
    ->name('admin.training_ses.create')
    ->middleware('Admin');

Route::post('admin/training-ses/store', [TrainingRecordSESController::class, 'store'])
    ->name('admin.training_ses.store')
    ->middleware('Admin');

Route::get('admin/training-ses/{id}/edit', [TrainingRecordSESController::class, 'edit'])
    ->name('admin.training_ses.edit')
    ->middleware('Admin');

Route::put('admin/training-ses/{id}', [TrainingRecordSESController::class, 'update'])
    ->name('admin.training_ses.update')
    ->middleware('Admin');

Route::delete('admin/training-ses/{id}', [TrainingRecordSESController::class, 'delete'])
    ->name('admin.training_ses.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/training-ses/{id}', [TrainingRecordSESController::class, 'show'])
    ->name('admin.training.training_ses.single')
    ->middleware('Admin');

// ================= Import =================================================

Route::post('admin/training-ses/import', [TrainingRecordSESController::class, 'import'])
    ->name('admin.training_ses.import')
    ->middleware('Admin');



// =========================== SA ===========================================

// ========= Authorized Auditors ===========================================

Route::get('admin/authorized-auditors/create', [AuthorizedAuditorController::class, 'create'])
    ->name('admin.auditor.create')
    ->middleware('Admin');

Route::post('admin/authorized-auditors/store', [AuthorizedAuditorController::class, 'store'])
    ->name('admin.auditor.store')
    ->middleware('Admin');

Route::get('admin/authorized-auditors/{id}/edit', [AuthorizedAuditorController::class, 'edit'])
    ->name('admin.auditor.edit')
    ->middleware('Admin');

Route::put('admin/authorized-auditors/{id}', [AuthorizedAuditorController::class, 'update'])
    ->name('admin.auditor.update')
    ->middleware('Admin');

Route::delete('admin/authorized-auditors/{id}', [AuthorizedAuditorController::class, 'delete'])
    ->name('admin.auditor.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/authorized-auditors/{id}', [AuthorizedAuditorController::class, 'show'])
    ->name('admin.auditor.single')
    ->middleware('Admin');

// ========= Print & Download ======================================

Route::get('admin/authorized-auditors/{id}/print', [AuthorizedAuditorController::class, 'print'])
    ->name('admin.auditor.print')
    ->middleware('Admin');

Route::get('admin/authorized-auditors/{id}/download', [AuthorizedAuditorController::class, 'download'])
    ->name('admin.auditor.download')
    ->middleware('Admin');


// ========= Import ================================================

Route::post('admin/authorized-auditors/import', [AuthorizedAuditorController::class, 'import'])
    ->name('admin.auditor.import')
    ->middleware('Admin');




// ========= Training Record - SA ===========================================

Route::get('admin/training-record-sa/create', [TrainingRecordSaController::class, 'create'])
    ->name('admin.training_sa.create')
    ->middleware('Admin');

Route::post('admin/training-record-sa/store', [TrainingRecordSaController::class, 'store'])
    ->name('admin.training_sa.store')
    ->middleware('Admin');

Route::get('admin/training-record-sa/{id}/edit', [TrainingRecordSaController::class, 'edit'])
    ->name('admin.training_sa.edit')
    ->middleware('Admin');

Route::put('admin/training-record-sa/{id}', [TrainingRecordSaController::class, 'update'])
    ->name('admin.training_sa.update')
    ->middleware('Admin');

Route::delete('admin/training-record-sa/{id}', [TrainingRecordSaController::class, 'delete'])
    ->name('admin.training_sa.delete')
    ->middleware('Admin');

// PUT THIS LAST
Route::get('admin/training-record-sa/{id}', [TrainingRecordSaController::class, 'show'])
    ->name('admin.training_sa.single')
    ->middleware('Admin');


// ========= Import ================================================

Route::post('admin/training-record-sa/import', [TrainingRecordSaController::class, 'import'])
    ->name('admin.training_sa.import')
    ->middleware('Admin');




































































//============= Director Routes =========================================================================




// ========== Dashboard/Manual ==========================================================
Route::get('/director/dashboard', [DirectorController::class, 'dashboard'])
    ->name('director.dashboard')->middleware('Director');














// ========= Ramp Inspection (Director) ===========================================

// View All Ramp Inspections
Route::get('/director/rampinspection/view', [DirectorRampInspectionController::class, 'view'])
    ->name('director.rampinspection.view')
    ->middleware('Director');

// View only Open findings
Route::get('/director/rampinspection/finding/view/open/{id}', [DirectorRampInspectionController::class, 'findingViewOpen'])
    ->name('director.rampinspection.finding.view.open')
    ->middleware('Director');

// View only Closed findings
Route::get('/director/rampinspection/finding/view/close/{id}', [DirectorRampInspectionController::class, 'findingViewClose'])
    ->name('director.rampinspection.finding.view.close')
    ->middleware('Director');

// Ramp Inspection Form
Route::get('/director/rampinspection/form', [DirectorRampInspectionController::class, 'form'])
    ->name('director.rampinspection.form')
    ->middleware('Director');

// Create Ramp Inspection
Route::post('/director/rampinspection/create', [DirectorRampInspectionController::class, 'create'])
    ->name('director.rampinspection.create')
    ->middleware('Director');

// Edit Ramp Inspection
Route::get('/director/rampinspection/edit/{id}', [DirectorRampInspectionController::class, 'edit'])
    ->name('director.rampinspection.edit')
    ->middleware('Director');

// Update Ramp Inspection
Route::post('/director/rampinspection/update/{id}', [DirectorRampInspectionController::class, 'update'])
    ->name('director.rampinspection.update')
    ->middleware('Director');

// Delete Ramp Inspection
Route::get('/director/rampinspection/delete/{id}', [DirectorRampInspectionController::class, 'delete'])
    ->name('director.rampinspection.delete')
    ->middleware('Director');


// Print & Download Ramp Inspection PDF
Route::get('/director/rampinspection/print/pdf/{id}', [DirectorRampInspectionController::class, 'generatePdf'])
    ->name('director.rampinspection.print.pdf')
    ->middleware('Director');

Route::get('/director/rampinspection/download/pdf/{id}', [DirectorRampInspectionController::class, 'downloadPdf'])
    ->name('director.rampinspection.download.pdf')
    ->middleware('Director');

// RampInspection PDF Export by Date Range
Route::get('/director/rampinspection/export/pdf', [DirectorRampInspectionController::class, 'exportRampInspectionsByDate'])
    ->name('director.rampinspection.range.pdf')
    ->middleware('Director');


// Excel Import
Route::post('/director/rampinspection/import', [DirectorRampInspectionController::class, 'importExcel'])
    ->name('director.rampinspection.import')
    ->middleware('Director');

// Excel Export (date range)
Route::get('/director/rampinspection/export/excel', [DirectorRampInspectionController::class, 'exportExcelByDate'])
    ->name('director.rampinspection.range.excel')
    ->middleware('Director');







// ========= Director Ramp Inspection Findings ===========================================

// View Findings
Route::get('/director/rampinspection/finding/view/{id}', [DirectorRampInspectionController::class, 'findingView'])
    ->name('director.rampinspection.finding.view')
    ->middleware('Director');

// Create Form
Route::get('/director/rampinspection/finding/form/{id}', [DirectorRampInspectionController::class, 'findingForm'])
    ->name('director.rampinspection.finding.form')
    ->middleware('Director');

// Store Finding
Route::post('/director/rampinspection/finding/create', [DirectorRampInspectionController::class, 'findingCreate'])
    ->name('director.rampinspection.finding.create')
    ->middleware('Director');

// Edit Form
Route::get('/director/rampinspection/finding/edit/{id}', [DirectorRampInspectionController::class, 'findingEdit'])
    ->name('director.rampinspection.finding.edit')
    ->middleware('Director');

// Update Finding
Route::post('/director/rampinspection/finding/update/{id}', [DirectorRampInspectionController::class, 'findingUpdate'])
    ->name('director.rampinspection.finding.update')
    ->middleware('Director');

// Delete Finding
Route::get('/director/rampinspection/finding/delete/{id}', [DirectorRampInspectionController::class, 'findingDelete'])
    ->name('director.rampinspection.finding.delete')
    ->middleware('Director');


// ========= Print & Download Ramp Inspection Finding ====================================

// Print PDF
Route::get('/director/rampinspection/finding/print/pdf/{id}', [DirectorRampInspectionController::class, 'printRampFinding'])
    ->name('director.rampinspection.finding.print.pdf')
    ->middleware('Director');

// Download PDF
Route::get('/director/rampinspection/finding/download/pdf/{id}', [DirectorRampInspectionController::class, 'downloadRampFinding'])
    ->name('director.rampinspection.finding.download.pdf')
    ->middleware('Director');


// ========= Export / Import Findings ===========================================

// Export PDF (by Date Range)
Route::get('/director/rampinspection/{ramp}/finding/export/pdf', [DirectorRampInspectionController::class, 'exportRampFindingsByDateRange'])
    ->name('director.rampinspection.finding.range.pdf')
    ->middleware('Director');

// Import Excel
Route::post('/director/rampinspection/{ramp}/finding/import', [DirectorRampInspectionController::class, 'importRampFindings'])
    ->name('director.rampinspection.finding.import')
    ->middleware('Director');

// Export Excel (by Date Range)
Route::get('/director/rampinspection/{ramp}/finding/export/excel', [DirectorRampInspectionController::class, 'exportRampFindingsExcelByDateRange'])
    ->name('director.rampinspection.finding.range.excel')
    ->middleware('Director');


// ========= Send Finding Email ===========================================

Route::post('/director/rampinspection/finding/{finding}/send-email', [DirectorRampInspectionController::class, 'sendFindingEmail'])
    ->name('director.rampinspection.finding.sendEmail')
    ->middleware('Director');













// ========= Ramp Inspection Reply ===========================================

// View Replies
Route::get('/director/rampinspection/finding/reply/view/{id}', [DirectorRampInspectionController::class, 'replyView'])
    ->name('director.rampinspection.finding.reply.view')
    ->middleware('Director');

// Reply Form
Route::get('/director/rampinspection/finding/reply/form/{id}', [DirectorRampInspectionController::class, 'replyForm'])
    ->name('director.rampinspection.finding.reply.form')
    ->middleware('Director');

// Create Reply
Route::post('/director/rampinspection/finding/reply/create', [DirectorRampInspectionController::class, 'replyCreate'])
    ->name('director.rampinspection.finding.reply.create')
    ->middleware('Director');

// Edit Reply
Route::get('/director/rampinspection/finding/reply/edit/{id}', [DirectorRampInspectionController::class, 'replyEdit'])
    ->name('director.rampinspection.finding.reply.edit')
    ->middleware('Director');

// Update Reply
Route::post('/director/rampinspection/finding/reply/update/{id}', [DirectorRampInspectionController::class, 'replyUpdate'])
    ->name('director.rampinspection.finding.reply.update')
    ->middleware('Director');

// Delete Reply
Route::get('/director/rampinspection/finding/reply/delete/{id}', [DirectorRampInspectionController::class, 'replyDelete'])
    ->name('director.rampinspection.finding.reply.delete')
    ->middleware('Director');


// ========= Print & Download ===========================================

// Print RampInspection Finding Reply PDF
Route::get('/director/rampinspection/finding/reply/print/{id}', [DirectorRampInspectionController::class, 'printRampReplies'])
    ->name('director.rampinspection.finding.reply.print.pdf')
    ->middleware('Director');

// Download RampInspection Finding Reply PDF
Route::get('/director/rampinspection/finding/reply/download/{id}', [DirectorRampInspectionController::class, 'downloadRampReplies'])
    ->name('director.rampinspection.finding.reply.download.pdf')
    ->middleware('Director');

// Export Replies of Ramp Finding by Date Range (PDF)
Route::get('/director/rampinspection/finding/{finding}/reply/export/pdf', [DirectorRampInspectionController::class, 'exportRepliesOfRampFindingByDateRange'])
    ->name('director.rampinspection.finding.reply.range.pdf')
    ->middleware('Director');


// ========= Excel Import / Export ===========================================

// Import Replies from Excel
Route::post('/director/rampinspection/finding/reply/import/{finding}', [DirectorRampInspectionController::class, 'importRampReplies'])
    ->name('director.rampinspection.finding.reply.import')
    ->middleware('Director');

// Export Replies to Excel (Date Range)
Route::get('/director/rampinspection/finding/{finding}/reply/export/excel', [DirectorRampInspectionController::class, 'exportRampRepliesExcelByDateRange'])
    ->name('director.rampinspection.finding.reply.export.excel')
    ->middleware('Director');








// ========= Audit ===========================================

Route::get('/director/audit/view', [DirectorAuditController::class, 'view'])->name('director.audit.view')->middleware('Director');

Route::get('/director/audit/form', [DirectorAuditController::class, 'form'])->name('director.audit.form')->middleware('Director');

Route::post('/director/audit/create', [DirectorAuditController::class, 'create'])->name('director.audit.create')->middleware('Director');

Route::get('/director/audit/edit/{id}', [DirectorAuditController::class, 'edit'])->name('director.audit.edit')->middleware('Director');

Route::post('/director/audit/update/{id}', [DirectorAuditController::class, 'update'])->name('director.audit.update')->middleware('Director');

Route::get('/director/audit/delete/{id}', [DirectorAuditController::class, 'delete'])->name('director.audit.delete')->middleware('Director');


// ========= Print & Download ===========================================

Route::get('/director/audit/print/pdf/{id}', [DirectorAuditController::class, 'generatePdf'])->name('director.audit.print.pdf')->middleware('Director');

Route::get('/director/audit/download/pdf/{id}', [DirectorAuditController::class, 'downloadPdf'])->name('director.audit.download.pdf')->middleware('Director');

// Audit PDF for date range
Route::get('/director/audit/export/pdf', [DirectorAuditController::class, 'exportAuditsByDate'])->name('director.audit.range.pdf')->middleware('Director');


// Audit Excel Import & Export
Route::post('/director/audit/import', [DirectorAuditController::class, 'import'])->name('director.audit.import')->middleware('Director');

Route::get('/director/audit/export/excel', [DirectorAuditController::class, 'exportExcelByDate'])->name('director.audit.range.excel')->middleware('Director');




// ========= Audit Findings ===========================================

Route::get('/director/audit/finding/view/{id}', [DirectorAuditController::class, 'findingView'])->name('director.audit.finding.view')->middleware('Director');

Route::get('/director/audit/finding/view/{id}/open', [DirectorAuditController::class, 'findingViewOpen'])->name('director.audit.finding.view.open')->middleware('Director');

Route::get('/director/audit/finding/view/{id}/close', [DirectorAuditController::class, 'findingViewClose'])->name('director.audit.finding.view.close')->middleware('Director');

Route::get('/director/audit/finding/form/{id}', [DirectorAuditController::class, 'findingForm'])->name('director.audit.finding.form')->middleware('Director');

Route::post('/director/audit/finding/create', [DirectorAuditController::class, 'findingCreate'])->name('director.audit.finding.create')->middleware('Director');

Route::get('/director/audit/finding/edit/{id}', [DirectorAuditController::class, 'findingEdit'])->name('director.audit.finding.edit')->middleware('Director');

Route::post('/director/audit/finding/update/{id}', [DirectorAuditController::class, 'findingUpdate'])->name('director.audit.finding.update')->middleware('Director');

Route::get('/director/audit/finding/delete/{id}', [DirectorAuditController::class, 'findingDelete'])->name('director.audit.finding.delete')->middleware('Director');

// ========= Print & Download ===========================================

Route::get('/director/audit/finding/print/pdf/{id}', [DirectorAuditController::class, 'printAuditFindings'])->name('director.audit.finding.print.pdf')->middleware('Director');

Route::get('/director/audit/finding/download/pdf/{id}', [DirectorAuditController::class, 'downloadAuditFindings'])->name('director.audit.finding.download.pdf')->middleware('Director');

// Export all findings by date range
Route::get('/director/audit/{audit}/finding/export/pdf', [DirectorAuditController::class, 'exportAuditFindingsByDateRange'])
    ->name('director.audit.finding.range.pdf')
    ->middleware('Director');

// Finding Excel Import & Export
Route::post('/director/finding/import', [DirectorAuditController::class, 'importAuditFindings'])->name('director.finding.import')->middleware('Director');

Route::get('/director/audit/{auditId}/finding/export/excel',[DirectorAuditController::class, 'exportFindingsByDate'])
    ->name('director.finding.export.excel')
    ->middleware('Director');


// Audit Finding Email
Route::post('/director/audit/finding/{id}/send-email', [DirectorAuditController::class, 'sendFindingEmail'])
    ->name('director.audit.finding.sendEmail')
    ->middleware('Director');




// ========= Audit Reply ===========================================

Route::get('/director/audit/finding/reply/view/{id}', [DirectorAuditController::class, 'replyView'])->name('director.audit.finding.reply.view')->middleware('Director');

Route::get('/director/audit/finding/reply/form/{id}', [DirectorAuditController::class, 'replyForm'])->name('director.audit.finding.reply.form')->middleware('Director');

Route::post('/director/audit/finding/reply/create', [DirectorAuditController::class, 'replyCreate'])->name('director.audit.finding.reply.create')->middleware('Director');

Route::get('/director/audit/finding/reply/edit/{id}', [DirectorAuditController::class, 'replyEdit'])->name('director.audit.finding.reply.edit')->middleware('Director');

Route::post('/director/audit/finding/reply/update/{id}', [DirectorAuditController::class, 'replyUpdate'])->name('director.audit.finding.reply.update')->middleware('Director');

Route::get('/director/audit/finding/reply/delete/{id}', [DirectorAuditController::class, 'replyDelete'])->name('director.audit.finding.reply.delete')->middleware('Director');


// ========= Audit Finding Print/Download with Reply ============================

Route::get('/director/audit/finding/reply/print/{id}', [DirectorAuditController::class, 'printAuditReplies'])
    ->name('director.audit.finding.reply.print.pdf')->middleware('Director');

Route::get('/director/audit/finding/reply/download/{id}', [DirectorAuditController::class, 'downloadAuditReplies'])
    ->name('director.audit.finding.reply.download.pdf')->middleware('Director');

Route::get('/director/finding/{finding}/reply/export/pdf', [DirectorAuditController::class, 'exportRepliesOfFindingByDateRange'])
    ->name('director.finding.reply.range.pdf')
    ->middleware('Director');

Route::post('/director/finding/reply/import', [DirectorAuditController::class, 'importAuditReplies'])
    ->name('director.reply.import')
    ->middleware('Director');

Route::get('/director/finding/{finding}/reply/export/excel', [DirectorAuditController::class, 'exportRepliesExcel'])
    ->name('director.finding.reply.range.excel')
    ->middleware('Director');














// =========================== Training & Auth ===========================================

// =========================== SES ===========================================




// ========= Staff ===========================================

Route::get('/director/training/view', [DirectorTrainingController::class, 'view'])
    ->name('director.training.view')->middleware('Director');

Route::get('/director/staff/form', [DirectorTrainingController::class, 'form'])
    ->name('director.staff.form')->middleware('Director');

Route::post('/director/staff/create', [DirectorTrainingController::class, 'create'])
    ->name('director.staff.create')->middleware('Director');

Route::get('/director/staff/edit/{id}', [DirectorTrainingController::class, 'edit'])
    ->name('director.staff.edit')->middleware('Director');

Route::put('/director/staff/update/{id}', [DirectorTrainingController::class, 'update'])
    ->name('director.staff.update')->middleware('Director');

Route::get('/director/staff/delete/{id}', [DirectorTrainingController::class, 'delete'])
    ->name('director.staff.delete')->middleware('Director');

// =================== Import ====================================================
Route::post('/director/staff/import', [DirectorTrainingController::class, 'import'])
    ->name('director.staff.import')->middleware('Director');









// ========= Aircraft Certifying Staff ===========================================

Route::get('director/aircraft-certifying-staff/create', [DirectorAircraftCertifyingStaffController::class, 'create'])
    ->name('director.aircraft.create')->middleware('Director');

Route::post('director/aircraft-certifying-staff/store', [DirectorAircraftCertifyingStaffController::class, 'store'])
    ->name('director.aircraft.store')->middleware('Director');

Route::get('director/aircraft-certifying-staff/{id}/edit', [DirectorAircraftCertifyingStaffController::class, 'edit'])
    ->name('director.aircraft.edit')->middleware('Director');

Route::put('director/aircraft-certifying-staff/{id}', [DirectorAircraftCertifyingStaffController::class, 'update'])
    ->name('director.aircraft.update')->middleware('Director');

Route::delete('director/aircraft-certifying-staff/{id}', [DirectorAircraftCertifyingStaffController::class, 'delete'])
    ->name('director.aircraft.delete')->middleware('Director');

// PUT THIS LAST
Route::get('director/aircraft-certifying-staff/{id}', [DirectorAircraftCertifyingStaffController::class, 'show'])
    ->name('director.training.acs.single')->middleware('Director');

// ========= Print & Download ===========================================

Route::get('director/aircraft-certifying-staff/{id}/print', [DirectorAircraftCertifyingStaffController::class, 'print'])
    ->name('director.aircraft.print')->middleware('Director');

Route::get('director/aircraft-certifying-staff/{id}/download', [DirectorAircraftCertifyingStaffController::class, 'download'])
    ->name('director.aircraft.download')->middleware('Director');

// ========= Import Aircraft Certifying Staff ===========================================

Route::post('director/aircraft-certifying-staff/import', [DirectorAircraftCertifyingStaffController::class, 'import'])
    ->name('director.aircraft.import')->middleware('Director');










// ========= Component Certifying Staff ===========================================

Route::get('director/component-certifying-staff/create', [DirectorComponentCertifyingStaffController::class, 'create'])
    ->name('director.component.create')->middleware('Director');

Route::post('director/component-certifying-staff/store', [DirectorComponentCertifyingStaffController::class, 'store'])
    ->name('director.component.store')->middleware('Director');

Route::get('director/component-certifying-staff/{id}/edit', [DirectorComponentCertifyingStaffController::class, 'edit'])
    ->name('director.component.edit')->middleware('Director');

Route::put('director/component-certifying-staff/{id}', [DirectorComponentCertifyingStaffController::class, 'update'])
    ->name('director.component.update')->middleware('Director');

Route::delete('director/component-certifying-staff/{id}', [DirectorComponentCertifyingStaffController::class, 'delete'])
    ->name('director.component.delete')->middleware('Director');

// PUT THIS LAST
Route::get('director/component-certifying-staff/{id}', [DirectorComponentCertifyingStaffController::class, 'show'])
    ->name('director.training.ccs.single')->middleware('Director');

// ========= Print & Download ===========================================

Route::get('director/component-certifying-staff/{id}/print', [DirectorComponentCertifyingStaffController::class, 'print'])
    ->name('director.component.print')->middleware('Director');

Route::get('director/component-certifying-staff/{id}/download', [DirectorComponentCertifyingStaffController::class, 'download'])
    ->name('director.component.download')->middleware('Director');

// ==================== Import ===========================================

Route::post('director/component-certifying-staff/import', [DirectorComponentCertifyingStaffController::class, 'import'])
    ->name('director.component.import')->middleware('Director');









// ========= Quality Auditors ===========================================

Route::get('director/quality-auditor/create', [DirectorQualityAuditorController::class, 'create'])
    ->name('director.quality.create')
    ->middleware('Director');

Route::post('director/quality-auditor/store', [DirectorQualityAuditorController::class, 'store'])
    ->name('director.quality.store')
    ->middleware('Director');

Route::get('director/quality-auditor/{id}/edit', [DirectorQualityAuditorController::class, 'edit'])
    ->name('director.quality.edit')
    ->middleware('Director');

Route::put('director/quality-auditor/{id}', [DirectorQualityAuditorController::class, 'update'])
    ->name('director.quality.update')
    ->middleware('Director');

Route::delete('director/quality-auditor/{id}', [DirectorQualityAuditorController::class, 'delete'])
    ->name('director.quality.delete')
    ->middleware('Director');

// PUT THIS LAST
Route::get('director/quality-auditor/{id}', [DirectorQualityAuditorController::class, 'show'])
    ->name('director.training.quality.single')
    ->middleware('Director');

// ========= Print & Download ===========================================

Route::get('director/quality-auditor/{id}/print', [DirectorQualityAuditorController::class, 'print'])
    ->name('director.quality.print')
    ->middleware('Director');

Route::get('director/quality-auditor/{id}/download', [DirectorQualityAuditorController::class, 'download'])
    ->name('director.quality.download')
    ->middleware('Director');

//========== Import Quality Auditor =====================================
Route::post('director/quality-auditor/import', [DirectorQualityAuditorController::class, 'import'])
    ->name('director.quality.import')
    ->middleware('Director');












// ========= Qualifying Mechanics ===========================================

Route::get('director/qualifying-mechanics/create', [DirectorQualifyingMechanicController::class, 'create'])
    ->name('director.qualifiedmechanic.create')
    ->middleware('Director');

Route::post('director/qualifying-mechanics/store', [DirectorQualifyingMechanicController::class, 'store'])
    ->name('director.qualifiedmechanic.store')
    ->middleware('Director');

Route::get('director/qualifying-mechanics/{id}/edit', [DirectorQualifyingMechanicController::class, 'edit'])
    ->name('director.qualifiedmechanic.edit')
    ->middleware('Director');

Route::put('director/qualifying-mechanics/{id}', [DirectorQualifyingMechanicController::class, 'update'])
    ->name('director.qualifiedmechanic.update')
    ->middleware('Director');

Route::delete('director/qualifying-mechanics/{id}', [DirectorQualifyingMechanicController::class, 'delete'])
    ->name('director.qualifiedmechanic.delete')
    ->middleware('Director');

// PUT THIS LAST
Route::get('director/qualifying-mechanics/{id}', [DirectorQualifyingMechanicController::class, 'show'])
    ->name('director.training.qm.single')
    ->middleware('Director');

// ========= Print & Download ===========================================

Route::get('director/qualifying-mechanics/{id}/print', [DirectorQualifyingMechanicController::class, 'print'])
    ->name('director.qm.print')
    ->middleware('Director');

Route::get('director/qualifying-mechanics/{id}/download', [DirectorQualifyingMechanicController::class, 'download'])
    ->name('director.qm.download')
    ->middleware('Director');

// ========= Import ===========================================
Route::post('director/qualifying-mechanics/import', [DirectorQualifyingMechanicController::class, 'import'])
    ->name('director.qm.import')
    ->middleware('Director');










// ========= Store Quality Inspectors ===========================================

Route::get('director/store-inspector/create', [DirectorStoreQualityInspectorController::class, 'create'])
    ->name('director.store_inspector.create')
    ->middleware('Director');

Route::post('director/store-inspector/store', [DirectorStoreQualityInspectorController::class, 'store'])
    ->name('director.store_inspector.store')
    ->middleware('Director');

Route::get('director/store-inspector/{id}/edit', [DirectorStoreQualityInspectorController::class, 'edit'])
    ->name('director.store_inspector.edit')
    ->middleware('Director');

Route::put('director/store-inspector/{id}', [DirectorStoreQualityInspectorController::class, 'update'])
    ->name('director.store_inspector.update')
    ->middleware('Director');

Route::delete('director/store-inspector/{id}', [DirectorStoreQualityInspectorController::class, 'delete'])
    ->name('director.store_inspector.delete')
    ->middleware('Director');

// PUT THIS LAST
Route::get('director/store-inspector/{id}', [DirectorStoreQualityInspectorController::class, 'show'])
    ->name('director.training.store_inspector.single')
    ->middleware('Director');

// ========= Print & Download ===========================================
Route::get('director/store-quality-inspectors/{id}/print', [DirectorStoreQualityInspectorController::class, 'print'])
    ->name('director.storeinspector.print')
    ->middleware('Director');

Route::get('director/store-quality-inspectors/{id}/download', [DirectorStoreQualityInspectorController::class, 'download'])
    ->name('director.storeinspector.download')
    ->middleware('Director');

// ========= Import ===========================================
Route::post('director/store-quality-inspectors/import', [DirectorStoreQualityInspectorController::class, 'import'])
    ->name('director.storeinspector.import')
    ->middleware('Director');








// ========= Authorized Standard Lab Personnel ===========================================

Route::get('director/standard-lab/create', [DirectorAuthorizedStandardLabPersonnelController::class, 'create'])
    ->name('director.standard_lab.create')
    ->middleware('Director');

Route::post('director/standard-lab/store', [DirectorAuthorizedStandardLabPersonnelController::class, 'store'])
    ->name('director.standard_lab.store')
    ->middleware('Director');

Route::get('director/standard-lab/{id}/edit', [DirectorAuthorizedStandardLabPersonnelController::class, 'edit'])
    ->name('director.standard_lab.edit')
    ->middleware('Director');

Route::put('director/standard-lab/{id}', [DirectorAuthorizedStandardLabPersonnelController::class, 'update'])
    ->name('director.standard_lab.update')
    ->middleware('Director');

Route::delete('director/standard-lab/{id}', [DirectorAuthorizedStandardLabPersonnelController::class, 'delete'])
    ->name('director.standard_lab.delete')
    ->middleware('Director');

// PUT THIS LAST
Route::get('director/standard-lab/{id}', [DirectorAuthorizedStandardLabPersonnelController::class, 'show'])
    ->name('director.training.standard_lab.single')
    ->middleware('Director');

// ========= Print & Download ===========================================
Route::get('director/standard-lab/{id}/print', [DirectorAuthorizedStandardLabPersonnelController::class, 'print'])
    ->name('director.standard_lab.print')
    ->middleware('Director');

Route::get('director/standard-lab/{id}/download', [DirectorAuthorizedStandardLabPersonnelController::class, 'download'])
    ->name('director.standard_lab.download')
    ->middleware('Director');

// ========= Import ===========================================
Route::post('director/standard-lab/import', [DirectorAuthorizedStandardLabPersonnelController::class, 'import'])
    ->name('director.standard_lab.import')
    ->middleware('Director');








// ========= Training Record SES ===========================================

Route::get('director/training-ses/create', [DirectorTrainingRecordSESController::class, 'create'])
    ->name('director.training_ses.create')
    ->middleware('Director');

Route::post('director/training-ses/store', [DirectorTrainingRecordSESController::class, 'store'])
    ->name('director.training_ses.store')
    ->middleware('Director');

Route::get('director/training-ses/{id}/edit', [DirectorTrainingRecordSESController::class, 'edit'])
    ->name('director.training_ses.edit')
    ->middleware('Director');

Route::put('director/training-ses/{id}', [DirectorTrainingRecordSESController::class, 'update'])
    ->name('director.training_ses.update')
    ->middleware('Director');

Route::delete('director/training-ses/{id}', [DirectorTrainingRecordSESController::class, 'delete'])
    ->name('director.training_ses.delete')
    ->middleware('Director');

// PUT THIS LAST
Route::get('director/training-ses/{id}', [DirectorTrainingRecordSESController::class, 'show'])
    ->name('director.training.training_ses.single')
    ->middleware('Director');

// ================= Import =================================================

Route::post('director/training-ses/import', [DirectorTrainingRecordSESController::class, 'import'])
    ->name('director.training_ses.import')
    ->middleware('Director');













// =========================== SA ===========================================

// ========= Authorized Auditors ===========================================

Route::get('director/authorized-auditors/create', [DirectorAuthorizedAuditorController::class, 'create'])
    ->name('director.auditor.create')
    ->middleware('Director');

Route::post('director/authorized-auditors/store', [DirectorAuthorizedAuditorController::class, 'store'])
    ->name('director.auditor.store')
    ->middleware('Director');

Route::get('director/authorized-auditors/{id}/edit', [DirectorAuthorizedAuditorController::class, 'edit'])
    ->name('director.auditor.edit')
    ->middleware('Director');

Route::put('director/authorized-auditors/{id}', [DirectorAuthorizedAuditorController::class, 'update'])
    ->name('director.auditor.update')
    ->middleware('Director');

Route::delete('director/authorized-auditors/{id}', [DirectorAuthorizedAuditorController::class, 'delete'])
    ->name('director.auditor.delete')
    ->middleware('Director');

// PUT THIS LAST
Route::get('director/authorized-auditors/{id}', [DirectorAuthorizedAuditorController::class, 'show'])
    ->name('director.auditor.single')
    ->middleware('Director');

// ========= Print & Download ======================================

Route::get('director/authorized-auditors/{id}/print', [DirectorAuthorizedAuditorController::class, 'print'])
    ->name('director.auditor.print')
    ->middleware('Director');

Route::get('director/authorized-auditors/{id}/download', [DirectorAuthorizedAuditorController::class, 'download'])
    ->name('director.auditor.download')
    ->middleware('Director');

// ========= Import ================================================

Route::post('director/authorized-auditors/import', [DirectorAuthorizedAuditorController::class, 'import'])
    ->name('director.auditor.import')
    ->middleware('Director');







// ========= Training Record - SA ===========================================

Route::get('director/training-record-sa/create', [DirectorTrainingRecordSaController::class, 'create'])
    ->name('director.training_sa.create')
    ->middleware('Director');

Route::post('director/training-record-sa/store', [DirectorTrainingRecordSaController::class, 'store'])
    ->name('director.training_sa.store')
    ->middleware('Director');

Route::get('director/training-record-sa/{id}/edit', [DirectorTrainingRecordSaController::class, 'edit'])
    ->name('director.training_sa.edit')
    ->middleware('Director');

Route::put('director/training-record-sa/{id}', [DirectorTrainingRecordSaController::class, 'update'])
    ->name('director.training_sa.update')
    ->middleware('Director');

Route::delete('director/training-record-sa/{id}', [DirectorTrainingRecordSaController::class, 'delete'])
    ->name('director.training_sa.delete')
    ->middleware('Director');

// PUT THIS LAST
Route::get('director/training-record-sa/{id}', [DirectorTrainingRecordSaController::class, 'show'])
    ->name('director.training_sa.single')
    ->middleware('Director');

// ========= Import ================================================

Route::post('director/training-record-sa/import', [DirectorTrainingRecordSaController::class, 'import'])
    ->name('director.training_sa.import')
    ->middleware('Director');
















































//============= Auditor Routes =========================================================================

// ============ Dashboard/Manual =============================================================
Route::get('/auditor/dashboard', [AuditorController::class, 'dashboard'])
    ->name('auditor.dashboard')->middleware('Auditor');











// ========= Ramp Inspection (Auditor) ===========================================

// View All Ramp Inspections
Route::get('/auditor/rampinspection/view', [AuditorRampInspectionController::class, 'view'])
    ->name('auditor.rampinspection.view')
    ->middleware('Auditor');

// View only Open findings
Route::get('/auditor/rampinspection/finding/view/open/{id}', [AuditorRampInspectionController::class, 'findingViewOpen'])
    ->name('auditor.rampinspection.finding.view.open')
    ->middleware('Auditor');

// View only Closed findings
Route::get('/auditor/rampinspection/finding/view/close/{id}', [AuditorRampInspectionController::class, 'findingViewClose'])
    ->name('auditor.rampinspection.finding.view.close')
    ->middleware('Auditor');

// Ramp Inspection Form
Route::get('/auditor/rampinspection/form', [AuditorRampInspectionController::class, 'form'])
    ->name('auditor.rampinspection.form')
    ->middleware('Auditor');

// Create Ramp Inspection
Route::post('/auditor/rampinspection/create', [AuditorRampInspectionController::class, 'create'])
    ->name('auditor.rampinspection.create')
    ->middleware('Auditor');

// Edit Ramp Inspection
Route::get('/auditor/rampinspection/edit/{id}', [AuditorRampInspectionController::class, 'edit'])
    ->name('auditor.rampinspection.edit')
    ->middleware('Auditor');

// Update Ramp Inspection
Route::post('/auditor/rampinspection/update/{id}', [AuditorRampInspectionController::class, 'update'])
    ->name('auditor.rampinspection.update')
    ->middleware('Auditor');

// Delete Ramp Inspection
Route::get('/auditor/rampinspection/delete/{id}', [AuditorRampInspectionController::class, 'delete'])
    ->name('auditor.rampinspection.delete')
    ->middleware('Auditor');

// Print & Download Ramp Inspection PDF
Route::get('/auditor/rampinspection/print/pdf/{id}', [AuditorRampInspectionController::class, 'generatePdf'])
    ->name('auditor.rampinspection.print.pdf')
    ->middleware('Auditor');

Route::get('/auditor/rampinspection/download/pdf/{id}', [AuditorRampInspectionController::class, 'downloadPdf'])
    ->name('auditor.rampinspection.download.pdf')
    ->middleware('Auditor');

// RampInspection PDF Export by Date Range
Route::get('/auditor/rampinspection/export/pdf', [AuditorRampInspectionController::class, 'exportRampInspectionsByDate'])
    ->name('auditor.rampinspection.range.pdf')
    ->middleware('Auditor');

// Excel Import
Route::post('/auditor/rampinspection/import', [AuditorRampInspectionController::class, 'importExcel'])
    ->name('auditor.rampinspection.import')
    ->middleware('Auditor');

// Excel Export (date range)
Route::get('/auditor/rampinspection/export/excel', [AuditorRampInspectionController::class, 'exportExcelByDate'])
    ->name('auditor.rampinspection.range.excel')
    ->middleware('Auditor');

















// ========= Auditor Ramp Inspection Findings ===========================================

// View Findings
Route::get('/auditor/rampinspection/finding/view/{id}', [AuditorRampInspectionController::class, 'findingView'])
    ->name('auditor.rampinspection.finding.view')
    ->middleware('Auditor');

// Create Form
Route::get('/auditor/rampinspection/finding/form/{id}', [AuditorRampInspectionController::class, 'findingForm'])
    ->name('auditor.rampinspection.finding.form')
    ->middleware('Auditor');

// Store Finding
Route::post('/auditor/rampinspection/finding/create', [AuditorRampInspectionController::class, 'findingCreate'])
    ->name('auditor.rampinspection.finding.create')
    ->middleware('Auditor');

// Edit Form
Route::get('/auditor/rampinspection/finding/edit/{id}', [AuditorRampInspectionController::class, 'findingEdit'])
    ->name('auditor.rampinspection.finding.edit')
    ->middleware('Auditor');

// Update Finding
Route::post('/auditor/rampinspection/finding/update/{id}', [AuditorRampInspectionController::class, 'findingUpdate'])
    ->name('auditor.rampinspection.finding.update')
    ->middleware('Auditor');

// Delete Finding
Route::get('/auditor/rampinspection/finding/delete/{id}', [AuditorRampInspectionController::class, 'findingDelete'])
    ->name('auditor.rampinspection.finding.delete')
    ->middleware('Auditor');


// ========= Print & Download Ramp Inspection Finding ====================================

// Print PDF
Route::get('/auditor/rampinspection/finding/print/pdf/{id}', [AuditorRampInspectionController::class, 'printRampFinding'])
    ->name('auditor.rampinspection.finding.print.pdf')
    ->middleware('Auditor');

// Download PDF
Route::get('/auditor/rampinspection/finding/download/pdf/{id}', [AuditorRampInspectionController::class, 'downloadRampFinding'])
    ->name('auditor.rampinspection.finding.download.pdf')
    ->middleware('Auditor');


// ========= Export / Import Findings ===========================================

// Export PDF (by Date Range)
Route::get('/auditor/rampinspection/{ramp}/finding/export/pdf', [AuditorRampInspectionController::class, 'exportRampFindingsByDateRange'])
    ->name('auditor.rampinspection.finding.range.pdf')
    ->middleware('Auditor');

// Import Excel
Route::post('/auditor/rampinspection/{ramp}/finding/import', [AuditorRampInspectionController::class, 'importRampFindings'])
    ->name('auditor.rampinspection.finding.import')
    ->middleware('Auditor');

// Export Excel (by Date Range)
Route::get('/auditor/rampinspection/{ramp}/finding/export/excel', [AuditorRampInspectionController::class, 'exportRampFindingsExcelByDateRange'])
    ->name('auditor.rampinspection.finding.range.excel')
    ->middleware('Auditor');


// ========= Send Finding Email ===========================================

Route::post('/auditor/rampinspection/finding/{finding}/send-email', [AuditorRampInspectionController::class, 'sendFindingEmail'])
    ->name('auditor.rampinspection.finding.sendEmail')
    ->middleware('Auditor');


















// ========= Ramp Inspection Reply ===========================================

// View Replies
Route::get('/auditor/rampinspection/finding/reply/view/{id}', [AuditorRampInspectionController::class, 'replyView'])
    ->name('auditor.rampinspection.finding.reply.view')
    ->middleware('Auditor');

// Reply Form
Route::get('/auditor/rampinspection/finding/reply/form/{id}', [AuditorRampInspectionController::class, 'replyForm'])
    ->name('auditor.rampinspection.finding.reply.form')
    ->middleware('Auditor');

// Create Reply
Route::post('/auditor/rampinspection/finding/reply/create', [AuditorRampInspectionController::class, 'replyCreate'])
    ->name('auditor.rampinspection.finding.reply.create')
    ->middleware('Auditor');

// Edit Reply
Route::get('/auditor/rampinspection/finding/reply/edit/{id}', [AuditorRampInspectionController::class, 'replyEdit'])
    ->name('auditor.rampinspection.finding.reply.edit')
    ->middleware('Auditor');

// Update Reply
Route::post('/auditor/rampinspection/finding/reply/update/{id}', [AuditorRampInspectionController::class, 'replyUpdate'])
    ->name('auditor.rampinspection.finding.reply.update')
    ->middleware('Auditor');

// Delete Reply
Route::get('/auditor/rampinspection/finding/reply/delete/{id}', [AuditorRampInspectionController::class, 'replyDelete'])
    ->name('auditor.rampinspection.finding.reply.delete')
    ->middleware('Auditor');


// ========= Print & Download ===========================================

// Print RampInspection Finding Reply PDF
Route::get('/auditor/rampinspection/finding/reply/print/{id}', [AuditorRampInspectionController::class, 'printRampReplies'])
    ->name('auditor.rampinspection.finding.reply.print.pdf')
    ->middleware('Auditor');

// Download RampInspection Finding Reply PDF
Route::get('/auditor/rampinspection/finding/reply/download/{id}', [AuditorRampInspectionController::class, 'downloadRampReplies'])
    ->name('auditor.rampinspection.finding.reply.download.pdf')
    ->middleware('Auditor');

// Export Replies of Ramp Finding by Date Range (PDF)
Route::get('/auditor/rampinspection/finding/{finding}/reply/export/pdf', [AuditorRampInspectionController::class, 'exportRepliesOfRampFindingByDateRange'])
    ->name('auditor.rampinspection.finding.reply.range.pdf')
    ->middleware('Auditor');


// ========= Excel Import / Export ===========================================

// Import Replies from Excel
Route::post('/auditor/rampinspection/finding/reply/import/{finding}', [AuditorRampInspectionController::class, 'importRampReplies'])
    ->name('auditor.rampinspection.finding.reply.import')
    ->middleware('Auditor');

// Export Replies to Excel (Date Range)
Route::get('/auditor/rampinspection/finding/{finding}/reply/export/excel', [AuditorRampInspectionController::class, 'exportRampRepliesExcelByDateRange'])
    ->name('auditor.rampinspection.finding.reply.export.excel')
    ->middleware('Auditor');













// ========= Audit ===========================================
Route::get('/auditor/audit/view', [AuditorAuditController::class, 'view'])->name('auditor.audit.view')->middleware('Auditor');

Route::get('/auditor/audit/form', [AuditorAuditController::class, 'form'])->name('auditor.audit.form')->middleware('Auditor');

Route::post('/auditor/audit/create', [AuditorAuditController::class, 'create'])->name('auditor.audit.create')->middleware('Auditor');

Route::get('/auditor/audit/edit/{id}', [AuditorAuditController::class, 'edit'])->name('auditor.audit.edit')->middleware('Auditor');

Route::post('/auditor/audit/update/{id}', [AuditorAuditController::class, 'update'])->name('auditor.audit.update')->middleware('Auditor');

Route::get('/auditor/audit/delete/{id}', [AuditorAuditController::class, 'delete'])->name('auditor.audit.delete')->middleware('Auditor');


// ========= Print & Download ===========================================
Route::get('/auditor/audit/print/pdf/{id}', [AuditorAuditController::class, 'generatePdf'])->name('auditor.audit.print.pdf')->middleware('Auditor');

Route::get('/auditor/audit/download/pdf/{id}', [AuditorAuditController::class, 'downloadPdf'])->name('auditor.audit.download.pdf')->middleware('Auditor');

Route::get('/auditor/audit/export/pdf', [AuditorAuditController::class, 'exportAuditsByDate'])->name('auditor.audit.range.pdf')->middleware('Auditor');

Route::post('/auditor/audit/import', [AuditorAuditController::class, 'import'])->name('auditor.audit.import')->middleware('Auditor');

Route::get('/auditor/audit/export/excel', [AuditorAuditController::class, 'exportExcelByDate'])->name('auditor.audit.range.excel')->middleware('Auditor');











// ========= Audit Findings ===========================================
Route::get('/auditor/audit/finding/view/{id}', [AuditorAuditController::class, 'findingView'])->name('auditor.audit.finding.view')->middleware('Auditor');

Route::get('/auditor/audit/finding/view/{id}/open', [AuditorAuditController::class, 'findingViewOpen'])->name('auditor.audit.finding.view.open')->middleware('Auditor');

Route::get('/auditor/audit/finding/view/{id}/close', [AuditorAuditController::class, 'findingViewClose'])->name('auditor.audit.finding.view.close')->middleware('Auditor');

Route::get('/auditor/audit/finding/form/{id}', [AuditorAuditController::class, 'findingForm'])->name('auditor.audit.finding.form')->middleware('Auditor');

Route::post('/auditor/audit/finding/create', [AuditorAuditController::class, 'findingCreate'])->name('auditor.audit.finding.create')->middleware('Auditor');

Route::get('/auditor/audit/finding/edit/{id}', [AuditorAuditController::class, 'findingEdit'])->name('auditor.audit.finding.edit')->middleware('Auditor');

Route::post('/auditor/audit/finding/update/{id}', [AuditorAuditController::class, 'findingUpdate'])->name('auditor.audit.finding.update')->middleware('Auditor');

Route::get('/auditor/audit/finding/delete/{id}', [AuditorAuditController::class, 'findingDelete'])->name('auditor.audit.finding.delete')->middleware('Auditor');


// ========= Audit Findings Print & Download ===========================================
Route::get('/auditor/audit/finding/print/pdf/{id}', [AuditorAuditController::class, 'printAuditFindings'])->name('auditor.audit.finding.print.pdf')->middleware('Auditor');

Route::get('/auditor/audit/finding/download/pdf/{id}', [AuditorAuditController::class, 'downloadAuditFindings'])->name('auditor.audit.finding.download.pdf')->middleware('Auditor');

Route::get('/auditor/audit/{audit}/finding/export/pdf', [AuditorAuditController::class, 'exportAuditFindingsByDateRange'])->name('auditor.audit.finding.range.pdf')->middleware('Auditor');

Route::post('/auditor/finding/import', [AuditorAuditController::class, 'importAuditFindings'])->name('auditor.finding.import')->middleware('Auditor');

Route::get('/auditor/audit/{auditId}/finding/export/excel',[AuditorAuditController::class, 'exportFindingsByDate'])
    ->name('auditor.finding.export.excel')
    ->middleware('Auditor');

Route::post('/auditor/audit/finding/{id}/send-email', [AuditorAuditController::class, 'sendFindingEmail'])->name('auditor.audit.finding.sendEmail')->middleware('Auditor');












// ========= Audit Reply ===========================================
Route::get('/auditor/audit/finding/reply/view/{id}', [AuditorAuditController::class, 'replyView'])->name('auditor.audit.finding.reply.view')->middleware('Auditor');

Route::get('/auditor/audit/finding/reply/form/{id}', [AuditorAuditController::class, 'replyForm'])->name('auditor.audit.finding.reply.form')->middleware('Auditor');

Route::post('/auditor/audit/finding/reply/create', [AuditorAuditController::class, 'replyCreate'])->name('auditor.audit.finding.reply.create')->middleware('Auditor');

Route::get('/auditor/audit/finding/reply/edit/{id}', [AuditorAuditController::class, 'replyEdit'])->name('auditor.audit.finding.reply.edit')->middleware('Auditor');

Route::post('/auditor/audit/finding/reply/update/{id}', [AuditorAuditController::class, 'replyUpdate'])->name('auditor.audit.finding.reply.update')->middleware('Auditor');

Route::get('/auditor/audit/finding/reply/delete/{id}', [AuditorAuditController::class, 'replyDelete'])->name('auditor.audit.finding.reply.delete')->middleware('Auditor');


// ========= Audit Reply Print & Download ===========================================
Route::get('/auditor/audit/finding/reply/print/{id}', [AuditorAuditController::class, 'printAuditReplies'])->name('auditor.audit.finding.reply.print.pdf')->middleware('Auditor');

Route::get('/auditor/audit/finding/reply/download/{id}', [AuditorAuditController::class, 'downloadAuditReplies'])->name('auditor.audit.finding.reply.download.pdf')->middleware('Auditor');

Route::get('/auditor/finding/{finding}/reply/export/pdf', [AuditorAuditController::class, 'exportRepliesOfFindingByDateRange'])->name('auditor.finding.reply.range.pdf')->middleware('Auditor');

Route::post('/auditor/finding/reply/import', [AuditorAuditController::class, 'importAuditReplies'])->name('auditor.reply.import')->middleware('Auditor');

Route::get('/auditor/finding/{finding}/reply/export/excel', [AuditorAuditController::class, 'exportRepliesExcel'])->name('auditor.finding.reply.range.excel')->middleware('Auditor');









// =========================== Training & Auth ===========================================


// =========================== SES ===========================================


// ========= Staff ===========================================

Route::get('/auditor/training/view', [AuditorTrainingController::class, 'view'])
    ->name('auditor.training.view')
    ->middleware('Auditor');

Route::get('/auditor/staff/form', [AuditorTrainingController::class, 'form'])
    ->name('auditor.staff.form')
    ->middleware('Auditor');

Route::post('/auditor/staff/create', [AuditorTrainingController::class, 'create'])
    ->name('auditor.staff.create')
    ->middleware('Auditor');

Route::get('/auditor/staff/edit/{id}', [AuditorTrainingController::class, 'edit'])
    ->name('auditor.staff.edit')
    ->middleware('Auditor');

Route::put('/auditor/staff/update/{id}', [AuditorTrainingController::class, 'update'])
    ->name('auditor.staff.update')
    ->middleware('Auditor');

Route::get('/auditor/staff/delete/{id}', [AuditorTrainingController::class, 'delete'])
    ->name('auditor.staff.delete')
    ->middleware('Auditor');

// =================== Import ====================================================

Route::post('/auditor/staff/import', [AuditorTrainingController::class, 'import'])
    ->name('auditor.staff.import')
    ->middleware('Auditor');








// ========= Aircraft Certifying Staff ===========================================

Route::get('auditor/aircraft-certifying-staff/create', [AuditorAircraftCertifyingStaffController::class, 'create'])
    ->name('auditor.aircraft.create')
    ->middleware('Auditor');

Route::post('auditor/aircraft-certifying-staff/store', [AuditorAircraftCertifyingStaffController::class, 'store'])
    ->name('auditor.aircraft.store')
    ->middleware('Auditor');

Route::get('auditor/aircraft-certifying-staff/{id}/edit', [AuditorAircraftCertifyingStaffController::class, 'edit'])
    ->name('auditor.aircraft.edit')
    ->middleware('Auditor');

Route::put('auditor/aircraft-certifying-staff/{id}', [AuditorAircraftCertifyingStaffController::class, 'update'])
    ->name('auditor.aircraft.update')
    ->middleware('Auditor');

Route::delete('auditor/aircraft-certifying-staff/{id}', [AuditorAircraftCertifyingStaffController::class, 'delete'])
    ->name('auditor.aircraft.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/aircraft-certifying-staff/{id}', [AuditorAircraftCertifyingStaffController::class, 'show'])
    ->name('auditor.training.acs.single')
    ->middleware('Auditor');

// ========= Print & Download ===========================================

Route::get('auditor/aircraft-certifying-staff/{id}/print', [AuditorAircraftCertifyingStaffController::class, 'print'])
    ->name('auditor.aircraft.print')
    ->middleware('Auditor');

Route::get('auditor/aircraft-certifying-staff/{id}/download', [AuditorAircraftCertifyingStaffController::class, 'download'])
    ->name('auditor.aircraft.download')
    ->middleware('Auditor');

// ========= Import Aircraft Certifying Staff ===========================================
Route::post('auditor/aircraft-certifying-staff/import', [AuditorAircraftCertifyingStaffController::class, 'import'])
    ->name('auditor.aircraft.import')
    ->middleware('Auditor');










// ========= Component Certifying Staff ===========================================

Route::get('auditor/component-certifying-staff/create', [AuditorComponentCertifyingStaffController::class, 'create'])
    ->name('auditor.component.create')
    ->middleware('Auditor');

Route::post('auditor/component-certifying-staff/store', [AuditorComponentCertifyingStaffController::class, 'store'])
    ->name('auditor.component.store')
    ->middleware('Auditor');

Route::get('auditor/component-certifying-staff/{id}/edit', [AuditorComponentCertifyingStaffController::class, 'edit'])
    ->name('auditor.component.edit')
    ->middleware('Auditor');

Route::put('auditor/component-certifying-staff/{id}', [AuditorComponentCertifyingStaffController::class, 'update'])
    ->name('auditor.component.update')
    ->middleware('Auditor');

Route::delete('auditor/component-certifying-staff/{id}', [AuditorComponentCertifyingStaffController::class, 'delete'])
    ->name('auditor.component.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/component-certifying-staff/{id}', [AuditorComponentCertifyingStaffController::class, 'show'])
    ->name('auditor.training.ccs.single')
    ->middleware('Auditor');

// ========= Print & Download ===========================================

Route::get('auditor/component-certifying-staff/{id}/print', [AuditorComponentCertifyingStaffController::class, 'print'])
    ->name('auditor.component.print')
    ->middleware('Auditor');

Route::get('auditor/component-certifying-staff/{id}/download', [AuditorComponentCertifyingStaffController::class, 'download'])
    ->name('auditor.component.download')
    ->middleware('Auditor');

// ==================== Import ===========================================

Route::post('auditor/component-certifying-staff/import', [AuditorComponentCertifyingStaffController::class, 'import'])
    ->name('auditor.component.import')
    ->middleware('Auditor');












// ========= Quality Auditors ===========================================

Route::get('auditor/quality-auditor/create', [AuditorQualityAuditorController::class, 'create'])
    ->name('auditor.quality.create')
    ->middleware('Auditor');

Route::post('auditor/quality-auditor/store', [AuditorQualityAuditorController::class, 'store'])
    ->name('auditor.quality.store')
    ->middleware('Auditor');

Route::get('auditor/quality-auditor/{id}/edit', [AuditorQualityAuditorController::class, 'edit'])
    ->name('auditor.quality.edit')
    ->middleware('Auditor');

Route::put('auditor/quality-auditor/{id}', [AuditorQualityAuditorController::class, 'update'])
    ->name('auditor.quality.update')
    ->middleware('Auditor');

Route::delete('auditor/quality-auditor/{id}', [AuditorQualityAuditorController::class, 'delete'])
    ->name('auditor.quality.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/quality-auditor/{id}', [AuditorQualityAuditorController::class, 'show'])
    ->name('auditor.training.quality.single')
    ->middleware('Auditor');

// ========= Print & Download ===========================================

Route::get('auditor/quality-auditor/{id}/print', [AuditorQualityAuditorController::class, 'print'])
    ->name('auditor.quality.print')
    ->middleware('Auditor');

Route::get('auditor/quality-auditor/{id}/download', [AuditorQualityAuditorController::class, 'download'])
    ->name('auditor.quality.download')
    ->middleware('Auditor');

//========== Import Quality Auditor =====================================
Route::post('auditor/quality-auditor/import', [AuditorQualityAuditorController::class, 'import'])
    ->name('auditor.quality.import')
    ->middleware('Auditor');












// ========= Qualifying Mechanics ===========================================

Route::get('auditor/qualifying-mechanics/create', [AuditorQualifyingMechanicController::class, 'create'])
    ->name('auditor.qualifiedmechanic.create')
    ->middleware('Auditor');

Route::post('auditor/qualifying-mechanics/store', [AuditorQualifyingMechanicController::class, 'store'])
    ->name('auditor.qualifiedmechanic.store')
    ->middleware('Auditor');

Route::get('auditor/qualifying-mechanics/{id}/edit', [AuditorQualifyingMechanicController::class, 'edit'])
    ->name('auditor.qualifiedmechanic.edit')
    ->middleware('Auditor');

Route::put('auditor/qualifying-mechanics/{id}', [AuditorQualifyingMechanicController::class, 'update'])
    ->name('auditor.qualifiedmechanic.update')
    ->middleware('Auditor');

Route::delete('auditor/qualifying-mechanics/{id}', [AuditorQualifyingMechanicController::class, 'delete'])
    ->name('auditor.qualifiedmechanic.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/qualifying-mechanics/{id}', [AuditorQualifyingMechanicController::class, 'show'])
    ->name('auditor.training.qm.single')
    ->middleware('Auditor');


// ========= Print & Download ===========================================

Route::get('auditor/qualifying-mechanics/{id}/print', [AuditorQualifyingMechanicController::class, 'print'])
    ->name('auditor.qm.print')
    ->middleware('Auditor');

Route::get('auditor/qualifying-mechanics/{id}/download', [AuditorQualifyingMechanicController::class, 'download'])
    ->name('auditor.qm.download')
    ->middleware('Auditor');

// ========= Import ===========================================

Route::post('auditor/qualifying-mechanics/import', [AuditorQualifyingMechanicController::class, 'import'])
    ->name('auditor.qm.import')
    ->middleware('Auditor');








// ========= Store Quality Inspectors ===========================================

Route::get('auditor/store-inspector/create', [AuditorStoreQualityInspectorController::class, 'create'])
    ->name('auditor.store_inspector.create')
    ->middleware('Auditor');

Route::post('auditor/store-inspector/store', [AuditorStoreQualityInspectorController::class, 'store'])
    ->name('auditor.store_inspector.store')
    ->middleware('Auditor');

Route::get('auditor/store-inspector/{id}/edit', [AuditorStoreQualityInspectorController::class, 'edit'])
    ->name('auditor.store_inspector.edit')
    ->middleware('Auditor');

Route::put('auditor/store-inspector/{id}', [AuditorStoreQualityInspectorController::class, 'update'])
    ->name('auditor.store_inspector.update')
    ->middleware('Auditor');

Route::delete('auditor/store-inspector/{id}', [AuditorStoreQualityInspectorController::class, 'delete'])
    ->name('auditor.store_inspector.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/store-inspector/{id}', [AuditorStoreQualityInspectorController::class, 'show'])
    ->name('auditor.training.store_inspector.single')
    ->middleware('Auditor');

// ========= Print & Download for Store Quality Inspectors ==========
Route::get('auditor/store-quality-inspectors/{id}/print', [AuditorStoreQualityInspectorController::class, 'print'])
    ->name('auditor.storeinspector.print')
    ->middleware('Auditor');

Route::get('auditor/store-quality-inspectors/{id}/download', [AuditorStoreQualityInspectorController::class, 'download'])
    ->name('auditor.storeinspector.download')
    ->middleware('Auditor');

// ========= Import ===========================================

Route::post('auditor/store-quality-inspectors/import', [AuditorStoreQualityInspectorController::class, 'import'])
    ->name('auditor.storeinspector.import')
    ->middleware('Auditor');




// ========= Authorized Standard Lab Personnel ===========================================

Route::get('auditor/standard-lab/create', [AuditorAuthorizedStandardLabPersonnelController::class, 'create'])
    ->name('auditor.standard_lab.create')
    ->middleware('Auditor');

Route::post('auditor/standard-lab/store', [AuditorAuthorizedStandardLabPersonnelController::class, 'store'])
    ->name('auditor.standard_lab.store')
    ->middleware('Auditor');

Route::get('auditor/standard-lab/{id}/edit', [AuditorAuthorizedStandardLabPersonnelController::class, 'edit'])
    ->name('auditor.standard_lab.edit')
    ->middleware('Auditor');

Route::put('auditor/standard-lab/{id}', [AuditorAuthorizedStandardLabPersonnelController::class, 'update'])
    ->name('auditor.standard_lab.update')
    ->middleware('Auditor');

Route::delete('auditor/standard-lab/{id}', [AuditorAuthorizedStandardLabPersonnelController::class, 'delete'])
    ->name('auditor.standard_lab.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/standard-lab/{id}', [AuditorAuthorizedStandardLabPersonnelController::class, 'show'])
    ->name('auditor.training.standard_lab.single')
    ->middleware('Auditor');

// ========= Print & Download ===========================================

Route::get('auditor/standard-lab/{id}/print', [AuditorAuthorizedStandardLabPersonnelController::class, 'print'])
    ->name('auditor.standard_lab.print')
    ->middleware('Auditor');

Route::get('auditor/standard-lab/{id}/download', [AuditorAuthorizedStandardLabPersonnelController::class, 'download'])
    ->name('auditor.standard_lab.download')
    ->middleware('Auditor');

// ========= Import =====================================================

Route::post('auditor/standard-lab/import', [AuditorAuthorizedStandardLabPersonnelController::class, 'import'])
    ->name('auditor.standard_lab.import')
    ->middleware('Auditor');







// ========= Training Record SES ===========================================

Route::get('auditor/training-ses/create', [AuditorTrainingRecordSESController::class, 'create'])
    ->name('auditor.training_ses.create')
    ->middleware('Auditor');

Route::post('auditor/training-ses/store', [AuditorTrainingRecordSESController::class, 'store'])
    ->name('auditor.training_ses.store')
    ->middleware('Auditor');

Route::get('auditor/training-ses/{id}/edit', [AuditorTrainingRecordSESController::class, 'edit'])
    ->name('auditor.training_ses.edit')
    ->middleware('Auditor');

Route::put('auditor/training-ses/{id}', [AuditorTrainingRecordSESController::class, 'update'])
    ->name('auditor.training_ses.update')
    ->middleware('Auditor');

Route::delete('auditor/training-ses/{id}', [AuditorTrainingRecordSESController::class, 'delete'])
    ->name('auditor.training_ses.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/training-ses/{id}', [AuditorTrainingRecordSESController::class, 'show'])
    ->name('auditor.training.training_ses.single')
    ->middleware('Auditor');

// ================= Import =================================================

Route::post('auditor/training-ses/import', [AuditorTrainingRecordSESController::class, 'import'])
    ->name('auditor.training_ses.import')
    ->middleware('Auditor');







// =========================== SA (Auditor) ===========================================

// ========= Authorized Auditors ===========================================

Route::get('auditor/authorized-auditors/create', [AuditorAuthorizedAuditorController::class, 'create'])
    ->name('auditor.auditor.create')
    ->middleware('Auditor');

Route::post('auditor/authorized-auditors/store', [AuditorAuthorizedAuditorController::class, 'store'])
    ->name('auditor.auditor.store')
    ->middleware('Auditor');

Route::get('auditor/authorized-auditors/{id}/edit', [AuditorAuthorizedAuditorController::class, 'edit'])
    ->name('auditor.auditor.edit')
    ->middleware('Auditor');

Route::put('auditor/authorized-auditors/{id}', [AuditorAuthorizedAuditorController::class, 'update'])
    ->name('auditor.auditor.update')
    ->middleware('Auditor');

Route::delete('auditor/authorized-auditors/{id}', [AuditorAuthorizedAuditorController::class, 'delete'])
    ->name('auditor.auditor.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/authorized-auditors/{id}', [AuditorAuthorizedAuditorController::class, 'show'])
    ->name('auditor.auditor.single')
    ->middleware('Auditor');

// ========= Print & Download ======================================

Route::get('auditor/authorized-auditors/{id}/print', [AuditorAuthorizedAuditorController::class, 'print'])
    ->name('auditor.auditor.print')
    ->middleware('Auditor');

Route::get('auditor/authorized-auditors/{id}/download', [AuditorAuthorizedAuditorController::class, 'download'])
    ->name('auditor.auditor.download')
    ->middleware('Auditor');

// ========= Import ================================================

Route::post('auditor/authorized-auditors/import', [AuditorAuthorizedAuditorController::class, 'import'])
    ->name('auditor.auditor.import')
    ->middleware('Auditor');








// ========= Training Record - SA ===========================================

Route::get('auditor/training-record-sa/create', [AuditorTrainingRecordSaController::class, 'create'])
    ->name('auditor.training_sa.create')
    ->middleware('Auditor');

Route::post('auditor/training-record-sa/store', [AuditorTrainingRecordSaController::class, 'store'])
    ->name('auditor.training_sa.store')
    ->middleware('Auditor');

Route::get('auditor/training-record-sa/{id}/edit', [AuditorTrainingRecordSaController::class, 'edit'])
    ->name('auditor.training_sa.edit')
    ->middleware('Auditor');

Route::put('auditor/training-record-sa/{id}', [AuditorTrainingRecordSaController::class, 'update'])
    ->name('auditor.training_sa.update')
    ->middleware('Auditor');

Route::delete('auditor/training-record-sa/{id}', [AuditorTrainingRecordSaController::class, 'delete'])
    ->name('auditor.training_sa.delete')
    ->middleware('Auditor');

// PUT THIS LAST
Route::get('auditor/training-record-sa/{id}', [AuditorTrainingRecordSaController::class, 'show'])
    ->name('auditor.training_sa.single')
    ->middleware('Auditor');

// ========= Import ================================================

Route::post('auditor/training-record-sa/import', [AuditorTrainingRecordSaController::class, 'import'])
    ->name('auditor.training_sa.import')
    ->middleware('Auditor');













































//============= Auditee Routes =========================================================================



// ========= Dashboard/Manual ===============================================================
Route::get('/auditee/dashboard', [AuditeeController::class, 'dashboard'])
    ->name('auditee.dashboard')->middleware('Auditee');










// ========= Ramp Inspection ===========================================

Route::get('/auditee/rampinspection/view', [AuditeeRampInspectionController::class, 'view'])
    ->name('auditee.rampinspection.view')->middleware('Auditee');

// View only Open findings
Route::get('/auditee/rampinspection/finding/view/open/{id}', [AuditeeRampInspectionController::class, 'findingViewOpen'])
    ->name('auditee.rampinspection.finding.view.open')
    ->middleware('Auditee');

// View only Closed findings
Route::get('/auditee/rampinspection/finding/view/close/{id}', [AuditeeRampInspectionController::class, 'findingViewClose'])
    ->name('auditee.rampinspection.finding.view.close')
    ->middleware('Auditee');

Route::get('/auditee/rampinspection/form', [AuditeeRampInspectionController::class, 'form'])
    ->name('auditee.rampinspection.form')->middleware('Auditee');

Route::post('/auditee/rampinspection/create', [AuditeeRampInspectionController::class, 'create'])
    ->name('auditee.rampinspection.create')->middleware('Auditee');

Route::get('/auditee/rampinspection/edit/{id}', [AuditeeRampInspectionController::class, 'edit'])
    ->name('auditee.rampinspection.edit')->middleware('Auditee');

Route::post('/auditee/rampinspection/update/{id}', [AuditeeRampInspectionController::class, 'update'])
    ->name('auditee.rampinspection.update')->middleware('Auditee');

Route::get('/auditee/rampinspection/delete/{id}', [AuditeeRampInspectionController::class, 'delete'])
    ->name('auditee.rampinspection.delete')->middleware('Auditee');


// Print & Download Ramp Inspection PDF
Route::get('/auditee/rampinspection/print/pdf/{id}', [AuditeeRampInspectionController::class, 'generatePdf'])
    ->name('auditee.rampinspection.print.pdf')->middleware('Auditee');

Route::get('/auditee/rampinspection/download/pdf/{id}', [AuditeeRampInspectionController::class, 'downloadPdf'])
    ->name('auditee.rampinspection.download.pdf')->middleware('Auditee');

// RampInspection PDF Export by Date Range
Route::get('/auditee/rampinspection/export/pdf', [AuditeeRampInspectionController::class, 'exportRampInspectionsByDate'])
    ->name('auditee.rampinspection.range.pdf')->middleware('Auditee');


// Excel Import
Route::post('/auditee/rampinspection/import', [AuditeeRampInspectionController::class, 'importExcel'])
    ->name('auditee.rampinspection.import')->middleware('Auditee');

// Excel Export (date range)
Route::get('/auditee/rampinspection/export/excel', [AuditeeRampInspectionController::class, 'exportExcelByDate'])
    ->name('auditee.rampinspection.range.excel')->middleware('Auditee');














// ========= Ramp Inspection Findings ===========================================

Route::get('/auditee/rampinspection/finding/view/{id}', [AuditeeRampInspectionController::class, 'findingView'])
    ->name('auditee.rampinspection.finding.view')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/form/{id}', [AuditeeRampInspectionController::class, 'findingForm'])
    ->name('auditee.rampinspection.finding.form')->middleware('Auditee');

Route::post('/auditee/rampinspection/finding/create', [AuditeeRampInspectionController::class, 'findingCreate'])
    ->name('auditee.rampinspection.finding.create')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/edit/{id}', [AuditeeRampInspectionController::class, 'findingEdit'])
    ->name('auditee.rampinspection.finding.edit')->middleware('Auditee');

Route::post('/auditee/rampinspection/finding/update/{id}', [AuditeeRampInspectionController::class, 'findingUpdate'])
    ->name('auditee.rampinspection.finding.update')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/delete/{id}', [AuditeeRampInspectionController::class, 'findingDelete'])
    ->name('auditee.rampinspection.finding.delete')->middleware('Auditee');


// Print & Download Ramp Inspection Finding
Route::get('/auditee/rampinspection/finding/print/pdf/{id}', [AuditeeRampInspectionController::class, 'printRampFinding'])
    ->name('auditee.rampinspection.finding.print.pdf')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/download/pdf/{id}', [AuditeeRampInspectionController::class, 'downloadRampFinding'])
    ->name('auditee.rampinspection.finding.download.pdf')->middleware('Auditee');


// Export all findings by date range
Route::get('/auditee/rampinspection/{ramp}/finding/export/pdf', [AuditeeRampInspectionController::class, 'exportRampFindingsByDateRange'])
    ->name('auditee.rampinspection.finding.range.pdf')->middleware('Auditee');

// Finding Excel Import
Route::post('/auditee/rampinspection/{ramp}/finding/import', [AuditeeRampInspectionController::class, 'importRampFindings'])
    ->name('auditee.rampinspection.finding.import')->middleware('Auditee');

// Finding Excel Export by Date Range
Route::get('/auditee/rampinspection/{ramp}/finding/export/excel', [AuditeeRampInspectionController::class, 'exportRampFindingsExcelByDateRange'])
    ->name('auditee.rampinspection.finding.range.excel')->middleware('Auditee');

// Finding Email
Route::post('/auditee/rampinspection/finding/{finding}/send-email', [AuditeeRampInspectionController::class, 'sendFindingEmail'])
    ->name('auditee.rampinspection.finding.sendEmail')->middleware('Auditee');













// ========= Ramp Inspection Reply ===========================================

Route::get('/auditee/rampinspection/finding/reply/view/{id}', [AuditeeRampInspectionController::class, 'replyView'])
    ->name('auditee.rampinspection.finding.reply.view')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/reply/form/{id}', [AuditeeRampInspectionController::class, 'replyForm'])
    ->name('auditee.rampinspection.finding.reply.form')->middleware('Auditee');

Route::post('/auditee/rampinspection/finding/reply/create', [AuditeeRampInspectionController::class, 'replyCreate'])
    ->name('auditee.rampinspection.finding.reply.create')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/reply/edit/{id}', [AuditeeRampInspectionController::class, 'replyEdit'])
    ->name('auditee.rampinspection.finding.reply.edit')->middleware('Auditee');

Route::post('/auditee/rampinspection/finding/reply/update/{id}', [AuditeeRampInspectionController::class, 'replyUpdate'])
    ->name('auditee.rampinspection.finding.reply.update')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/reply/delete/{id}', [AuditeeRampInspectionController::class, 'replyDelete'])
    ->name('auditee.rampinspection.finding.reply.delete')->middleware('Auditee');


// Print & Download RampInspection Finding Reply
Route::get('/auditee/rampinspection/finding/reply/print/{id}', [AuditeeRampInspectionController::class, 'printRampReplies'])
    ->name('auditee.rampinspection.finding.reply.print.pdf')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/reply/download/{id}', [AuditeeRampInspectionController::class, 'downloadRampReplies'])
    ->name('auditee.rampinspection.finding.reply.download.pdf')->middleware('Auditee');

Route::get('/auditee/rampinspection/finding/{finding}/reply/export/pdf', [AuditeeRampInspectionController::class, 'exportRepliesOfRampFindingByDateRange'])
    ->name('auditee.rampinspection.finding.reply.range.pdf')->middleware('Auditee');

// Reply Excel Import
Route::post('/auditee/rampinspection/finding/reply/import/{finding}', [AuditeeRampInspectionController::class, 'importRampReplies'])
    ->name('auditee.rampinspection.finding.reply.import')->middleware('Auditee');

// Reply Excel Export with Date Range
Route::get('/auditee/rampinspection/finding/{finding}/reply/export/excel', [AuditeeRampInspectionController::class, 'exportRampRepliesExcelByDateRange'])
    ->name('auditee.rampinspection.finding.reply.export.excel')->middleware('Auditee');














// ========= Audit ===========================================
Route::get('/auditee/audit/view', [AuditeeAuditController::class, 'view'])->name('auditee.audit.view')->middleware('Auditee');

Route::get('/auditee/audit/form', [AuditeeAuditController::class, 'form'])->name('auditee.audit.form')->middleware('Auditee');

Route::post('/auditee/audit/create', [AuditeeAuditController::class, 'create'])->name('auditee.audit.create')->middleware('Auditee');

Route::get('/auditee/audit/edit/{id}', [AuditeeAuditController::class, 'edit'])->name('auditee.audit.edit')->middleware('Auditee');

Route::post('/auditee/audit/update/{id}', [AuditeeAuditController::class, 'update'])->name('auditee.audit.update')->middleware('Auditee');

Route::get('/auditee/audit/delete/{id}', [AuditeeAuditController::class, 'delete'])->name('auditee.audit.delete')->middleware('Auditee');


// ========= Print & Download ===========================================
Route::get('/auditee/audit/print/pdf/{id}', [AuditeeAuditController::class, 'generatePdf'])->name('auditee.audit.print.pdf')->middleware('Auditee');

Route::get('/auditee/audit/download/pdf/{id}', [AuditeeAuditController::class, 'downloadPdf'])->name('auditee.audit.download.pdf')->middleware('Auditee');

Route::get('/auditee/audit/export/pdf', [AuditeeAuditController::class, 'exportAuditsByDate'])->name('auditee.audit.range.pdf')->middleware('Auditee');

Route::post('/auditee/audit/import', [AuditeeAuditController::class, 'import'])->name('auditee.audit.import')->middleware('Auditee');

Route::get('/auditee/audit/export/excel', [AuditeeAuditController::class, 'exportExcelByDate'])->name('auditee.audit.range.excel')->middleware('Auditee');








// ========= Audit Findings ===========================================
Route::get('/auditee/audit/finding/view/{id}', [AuditeeAuditController::class, 'findingView'])->name('auditee.audit.finding.view')->middleware('Auditee');

Route::get('/auditee/audit/finding/view/{id}/open', [AuditeeAuditController::class, 'findingViewOpen'])->name('auditee.audit.finding.view.open')->middleware('Auditee');

Route::get('/auditee/audit/finding/view/{id}/close', [AuditeeAuditController::class, 'findingViewClose'])->name('auditee.audit.finding.view.close')->middleware('Auditee');

Route::get('/auditee/audit/finding/form/{id}', [AuditeeAuditController::class, 'findingForm'])->name('auditee.audit.finding.form')->middleware('Auditee');

Route::post('/auditee/audit/finding/create', [AuditeeAuditController::class, 'findingCreate'])->name('auditee.audit.finding.create')->middleware('Auditee');

Route::get('/auditee/audit/finding/edit/{id}', [AuditeeAuditController::class, 'findingEdit'])->name('auditee.audit.finding.edit')->middleware('Auditee');

Route::post('/auditee/audit/finding/update/{id}', [AuditeeAuditController::class, 'findingUpdate'])->name('auditee.audit.finding.update')->middleware('Auditee');

Route::get('/auditee/audit/finding/delete/{id}', [AuditeeAuditController::class, 'findingDelete'])->name('auditee.audit.finding.delete')->middleware('Auditee');


// ========= Audit Findings Print & Download ===========================================
Route::get('/auditee/audit/finding/print/pdf/{id}', [AuditeeAuditController::class, 'printAuditFindings'])->name('auditee.audit.finding.print.pdf')->middleware('Auditee');

Route::get('/auditee/audit/finding/download/pdf/{id}', [AuditeeAuditController::class, 'downloadAuditFindings'])->name('auditee.audit.finding.download.pdf')->middleware('Auditee');

Route::get('/auditee/audit/{audit}/finding/export/pdf', [AuditeeAuditController::class, 'exportAuditFindingsByDateRange'])->name('auditee.audit.finding.range.pdf')->middleware('Auditee');

Route::post('/auditee/finding/import', [AuditeeAuditController::class, 'importAuditFindings'])->name('auditee.finding.import')->middleware('Auditee');

Route::get('/auditee/audit/{auditId}/finding/export/excel',[AuditeeAuditController::class, 'exportFindingsByDate'])
    ->name('auditee.finding.export.excel')
    ->middleware('Auditee');

Route::post('/auditee/audit/finding/{id}/send-email', [AuditeeAuditController::class, 'sendFindingEmail'])->name('auditee.audit.finding.sendEmail')->middleware('Auditee');










// ========= Audit Reply ===========================================
Route::get('/auditee/audit/finding/reply/view/{id}', [AuditeeAuditController::class, 'replyView'])->name('auditee.audit.finding.reply.view')->middleware('Auditee');

Route::get('/auditee/audit/finding/reply/form/{id}', [AuditeeAuditController::class, 'replyForm'])->name('auditee.audit.finding.reply.form')->middleware('Auditee');

Route::post('/auditee/audit/finding/reply/create', [AuditeeAuditController::class, 'replyCreate'])->name('auditee.audit.finding.reply.create')->middleware('Auditee');

Route::get('/auditee/audit/finding/reply/edit/{id}', [AuditeeAuditController::class, 'replyEdit'])->name('auditee.audit.finding.reply.edit')->middleware('Auditee');

Route::post('/auditee/audit/finding/reply/update/{id}', [AuditeeAuditController::class, 'replyUpdate'])->name('auditee.audit.finding.reply.update')->middleware('Auditee');

Route::get('/auditee/audit/finding/reply/delete/{id}', [AuditeeAuditController::class, 'replyDelete'])->name('auditee.audit.finding.reply.delete')->middleware('Auditee');


// ========= Audit Reply Print & Download ===========================================
Route::get('/auditee/audit/finding/reply/print/{id}', [AuditeeAuditController::class, 'printAuditReplies'])->name('auditee.audit.finding.reply.print.pdf')->middleware('Auditee');

Route::get('/auditee/audit/finding/reply/download/{id}', [AuditeeAuditController::class, 'downloadAuditReplies'])->name('auditee.audit.finding.reply.download.pdf')->middleware('Auditee');

Route::get('/auditee/finding/{finding}/reply/export/pdf', [AuditeeAuditController::class, 'exportRepliesOfFindingByDateRange'])->name('auditee.finding.reply.range.pdf')->middleware('Auditee');

Route::post('/auditee/finding/reply/import', [AuditeeAuditController::class, 'importAuditReplies'])->name('auditee.reply.import')->middleware('Auditee');

Route::get('/auditee/finding/{finding}/reply/export/excel', [AuditeeAuditController::class, 'exportRepliesExcel'])->name('auditee.finding.reply.range.excel')->middleware('Auditee');




















// =========================== Training & Auth ===========================================


// =========================== SES ===========================================

// ========= Staff ===========================================

Route::get('/auditee/training/view', [AuditeeTrainingController::class, 'view'])
    ->name('auditee.training.view')->middleware('Auditee');

Route::get('/auditee/staff/form', [AuditeeTrainingController::class, 'form'])
    ->name('auditee.staff.form')->middleware('Auditee');

Route::post('/auditee/staff/create', [AuditeeTrainingController::class, 'create'])
    ->name('auditee.staff.create')->middleware('Auditee');

Route::get('/auditee/staff/edit/{id}', [AuditeeTrainingController::class, 'edit'])
    ->name('auditee.staff.edit')->middleware('Auditee');

Route::put('/auditee/staff/update/{id}', [AuditeeTrainingController::class, 'update'])
    ->name('auditee.staff.update')->middleware('Auditee');

Route::get('/auditee/staff/delete/{id}', [AuditeeTrainingController::class, 'delete'])
    ->name('auditee.staff.delete')->middleware('Auditee');

// =================== Import ====================================================

Route::post('/auditee/staff/import', [AuditeeTrainingController::class, 'import'])
    ->name('auditee.staff.import')->middleware('Auditee');










// ========= Aircraft Certifying Staff ===========================================

Route::get('auditee/aircraft-certifying-staff/create', [AuditeeAircraftCertifyingStaffController::class, 'create'])
    ->name('auditee.aircraft.create')->middleware('Auditee');

Route::post('auditee/aircraft-certifying-staff/store', [AuditeeAircraftCertifyingStaffController::class, 'store'])
    ->name('auditee.aircraft.store')->middleware('Auditee');

Route::get('auditee/aircraft-certifying-staff/{id}/edit', [AuditeeAircraftCertifyingStaffController::class, 'edit'])
    ->name('auditee.aircraft.edit')->middleware('Auditee');

Route::put('auditee/aircraft-certifying-staff/{id}', [AuditeeAircraftCertifyingStaffController::class, 'update'])
    ->name('auditee.aircraft.update')->middleware('Auditee');

Route::delete('auditee/aircraft-certifying-staff/{id}', [AuditeeAircraftCertifyingStaffController::class, 'delete'])
    ->name('auditee.aircraft.delete')->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/aircraft-certifying-staff/{id}', [AuditeeAircraftCertifyingStaffController::class, 'show'])
    ->name('auditee.training.acs.single')->middleware('Auditee');

// ========= Print & Download ===========================================

Route::get('auditee/aircraft-certifying-staff/{id}/print', [AuditeeAircraftCertifyingStaffController::class, 'print'])
    ->name('auditee.aircraft.print')->middleware('Auditee');

Route::get('auditee/aircraft-certifying-staff/{id}/download', [AuditeeAircraftCertifyingStaffController::class, 'download'])
    ->name('auditee.aircraft.download')->middleware('Auditee');

// ========= Import Aircraft Certifying Staff ===========================================

Route::post('auditee/aircraft-certifying-staff/import', [AuditeeAircraftCertifyingStaffController::class, 'import'])
    ->name('auditee.aircraft.import')->middleware('Auditee');









// ========= Component Certifying Staff ===========================================

Route::get('auditee/component-certifying-staff/create', [AuditeeComponentCertifyingStaffController::class, 'create'])
    ->name('auditee.component.create')->middleware('Auditee');

Route::post('auditee/component-certifying-staff/store', [AuditeeComponentCertifyingStaffController::class, 'store'])
    ->name('auditee.component.store')->middleware('Auditee');

Route::get('auditee/component-certifying-staff/{id}/edit', [AuditeeComponentCertifyingStaffController::class, 'edit'])
    ->name('auditee.component.edit')->middleware('Auditee');

Route::put('auditee/component-certifying-staff/{id}', [AuditeeComponentCertifyingStaffController::class, 'update'])
    ->name('auditee.component.update')->middleware('Auditee');

Route::delete('auditee/component-certifying-staff/{id}', [AuditeeComponentCertifyingStaffController::class, 'delete'])
    ->name('auditee.component.delete')->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/component-certifying-staff/{id}', [AuditeeComponentCertifyingStaffController::class, 'show'])
    ->name('auditee.training.ccs.single')->middleware('Auditee');

// ========= Print & Download ===========================================

Route::get('auditee/component-certifying-staff/{id}/print', [AuditeeComponentCertifyingStaffController::class, 'print'])
    ->name('auditee.component.print')->middleware('Auditee');

Route::get('auditee/component-certifying-staff/{id}/download', [AuditeeComponentCertifyingStaffController::class, 'download'])
    ->name('auditee.component.download')->middleware('Auditee');

// ==================== Import ===========================================

Route::post('auditee/component-certifying-staff/import', [AuditeeComponentCertifyingStaffController::class, 'import'])
    ->name('auditee.component.import')->middleware('Auditee');











// ========= Quality Auditors ===========================================

Route::get('auditee/quality-auditor/create', [AuditeeQualityAuditorController::class, 'create'])
    ->name('auditee.quality.create')->middleware('Auditee');

Route::post('auditee/quality-auditor/store', [AuditeeQualityAuditorController::class, 'store'])
    ->name('auditee.quality.store')->middleware('Auditee');

Route::get('auditee/quality-auditor/{id}/edit', [AuditeeQualityAuditorController::class, 'edit'])
    ->name('auditee.quality.edit')->middleware('Auditee');

Route::put('auditee/quality-auditor/{id}', [AuditeeQualityAuditorController::class, 'update'])
    ->name('auditee.quality.update')->middleware('Auditee');

Route::delete('auditee/quality-auditor/{id}', [AuditeeQualityAuditorController::class, 'delete'])
    ->name('auditee.quality.delete')->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/quality-auditor/{id}', [AuditeeQualityAuditorController::class, 'show'])
    ->name('auditee.training.quality.single')->middleware('Auditee');

// ========= Print & Download ===========================================

Route::get('auditee/quality-auditor/{id}/print', [AuditeeQualityAuditorController::class, 'print'])
    ->name('auditee.quality.print')->middleware('Auditee');

Route::get('auditee/quality-auditor/{id}/download', [AuditeeQualityAuditorController::class, 'download'])
    ->name('auditee.quality.download')->middleware('Auditee');

//========== Import Quality Auditor =====================================

Route::post('auditee/quality-auditor/import', [AuditeeQualityAuditorController::class, 'import'])
    ->name('auditee.quality.import')->middleware('Auditee');














// ========= Qualifying Mechanics ===========================================

Route::get('auditee/qualifying-mechanics/create', [AuditeeQualifyingMechanicController::class, 'create'])
    ->name('auditee.qualifiedmechanic.create')
    ->middleware('Auditee');

Route::post('auditee/qualifying-mechanics/store', [AuditeeQualifyingMechanicController::class, 'store'])
    ->name('auditee.qualifiedmechanic.store')
    ->middleware('Auditee');

Route::get('auditee/qualifying-mechanics/{id}/edit', [AuditeeQualifyingMechanicController::class, 'edit'])
    ->name('auditee.qualifiedmechanic.edit')
    ->middleware('Auditee');

Route::put('auditee/qualifying-mechanics/{id}', [AuditeeQualifyingMechanicController::class, 'update'])
    ->name('auditee.qualifiedmechanic.update')
    ->middleware('Auditee');

Route::delete('auditee/qualifying-mechanics/{id}', [AuditeeQualifyingMechanicController::class, 'delete'])
    ->name('auditee.qualifiedmechanic.delete')
    ->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/qualifying-mechanics/{id}', [AuditeeQualifyingMechanicController::class, 'show'])
    ->name('auditee.training.qm.single')
    ->middleware('Auditee');

// ========= Print & Download ===========================================

Route::get('auditee/qualifying-mechanics/{id}/print', [AuditeeQualifyingMechanicController::class, 'print'])
    ->name('auditee.qm.print')
    ->middleware('Auditee');

Route::get('auditee/qualifying-mechanics/{id}/download', [AuditeeQualifyingMechanicController::class, 'download'])
    ->name('auditee.qm.download')
    ->middleware('Auditee');

// ========= Import ===========================================

Route::post('auditee/qualifying-mechanics/import', [AuditeeQualifyingMechanicController::class, 'import'])
    ->name('auditee.qm.import')
    ->middleware('Auditee');










// ========= Store Quality Inspectors ===========================================

Route::get('auditee/store-inspector/create', [AuditeeStoreQualityInspectorController::class, 'create'])
    ->name('auditee.store_inspector.create')
    ->middleware('Auditee');

Route::post('auditee/store-inspector/store', [AuditeeStoreQualityInspectorController::class, 'store'])
    ->name('auditee.store_inspector.store')
    ->middleware('Auditee');

Route::get('auditee/store-inspector/{id}/edit', [AuditeeStoreQualityInspectorController::class, 'edit'])
    ->name('auditee.store_inspector.edit')
    ->middleware('Auditee');

Route::put('auditee/store-inspector/{id}', [AuditeeStoreQualityInspectorController::class, 'update'])
    ->name('auditee.store_inspector.update')
    ->middleware('Auditee');

Route::delete('auditee/store-inspector/{id}', [AuditeeStoreQualityInspectorController::class, 'delete'])
    ->name('auditee.store_inspector.delete')
    ->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/store-inspector/{id}', [AuditeeStoreQualityInspectorController::class, 'show'])
    ->name('auditee.training.store_inspector.single')
    ->middleware('Auditee');

// ========= Print & Download for Store Quality Inspectors ==========
Route::get('auditee/store-quality-inspectors/{id}/print', [AuditeeStoreQualityInspectorController::class, 'print'])
    ->name('auditee.storeinspector.print')
    ->middleware('Auditee');

Route::get('auditee/store-quality-inspectors/{id}/download', [AuditeeStoreQualityInspectorController::class, 'download'])
    ->name('auditee.storeinspector.download')
    ->middleware('Auditee');

// ========= Import ===========================================

Route::post('auditee/store-quality-inspectors/import', [AuditeeStoreQualityInspectorController::class, 'import'])
    ->name('auditee.storeinspector.import')
    ->middleware('Auditee');









// ========= Authorized Standard Lab Personnel ===========================================

Route::get('auditee/standard-lab/create', [AuditeeAuthorizedStandardLabPersonnelController::class, 'create'])
    ->name('auditee.standard_lab.create')
    ->middleware('Auditee');

Route::post('auditee/standard-lab/store', [AuditeeAuthorizedStandardLabPersonnelController::class, 'store'])
    ->name('auditee.standard_lab.store')
    ->middleware('Auditee');

Route::get('auditee/standard-lab/{id}/edit', [AuditeeAuthorizedStandardLabPersonnelController::class, 'edit'])
    ->name('auditee.standard_lab.edit')
    ->middleware('Auditee');

Route::put('auditee/standard-lab/{id}', [AuditeeAuthorizedStandardLabPersonnelController::class, 'update'])
    ->name('auditee.standard_lab.update')
    ->middleware('Auditee');

Route::delete('auditee/standard-lab/{id}', [AuditeeAuthorizedStandardLabPersonnelController::class, 'delete'])
    ->name('auditee.standard_lab.delete')
    ->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/standard-lab/{id}', [AuditeeAuthorizedStandardLabPersonnelController::class, 'show'])
    ->name('auditee.training.standard_lab.single')
    ->middleware('Auditee');

// ========= Print & Download ===========================================

Route::get('auditee/standard-lab/{id}/print', [AuditeeAuthorizedStandardLabPersonnelController::class, 'print'])
    ->name('auditee.standard_lab.print')
    ->middleware('Auditee');

Route::get('auditee/standard-lab/{id}/download', [AuditeeAuthorizedStandardLabPersonnelController::class, 'download'])
    ->name('auditee.standard_lab.download')
    ->middleware('Auditee');

// ========= Import =====================================================

Route::post('auditee/standard-lab/import', [AuditeeAuthorizedStandardLabPersonnelController::class, 'import'])
    ->name('auditee.standard_lab.import')
    ->middleware('Auditee');








// ========= Training Record SES ===========================================

Route::get('auditee/training-ses/create', [AuditeeTrainingRecordSESController::class, 'create'])
    ->name('auditee.training_ses.create')
    ->middleware('Auditee');

Route::post('auditee/training-ses/store', [AuditeeTrainingRecordSESController::class, 'store'])
    ->name('auditee.training_ses.store')
    ->middleware('Auditee');

Route::get('auditee/training-ses/{id}/edit', [AuditeeTrainingRecordSESController::class, 'edit'])
    ->name('auditee.training_ses.edit')
    ->middleware('Auditee');

Route::put('auditee/training-ses/{id}', [AuditeeTrainingRecordSESController::class, 'update'])
    ->name('auditee.training_ses.update')
    ->middleware('Auditee');

Route::delete('auditee/training-ses/{id}', [AuditeeTrainingRecordSESController::class, 'delete'])
    ->name('auditee.training_ses.delete')
    ->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/training-ses/{id}', [AuditeeTrainingRecordSESController::class, 'show'])
    ->name('auditee.training.training_ses.single')
    ->middleware('Auditee');

// ================= Import =================================================

Route::post('auditee/training-ses/import', [AuditeeTrainingRecordSESController::class, 'import'])
    ->name('auditee.training_ses.import')
    ->middleware('Auditee');







// =========================== SA ===========================================


// ========= Authorized Auditors (Auditee) ===========================================

Route::get('auditee/authorized-auditors/create', [AuditeeAuthorizedAuditorController::class, 'create'])
    ->name('auditee.auditor.create')
    ->middleware('Auditee');

Route::post('auditee/authorized-auditors/store', [AuditeeAuthorizedAuditorController::class, 'store'])
    ->name('auditee.auditor.store')
    ->middleware('Auditee');

Route::get('auditee/authorized-auditors/{id}/edit', [AuditeeAuthorizedAuditorController::class, 'edit'])
    ->name('auditee.auditor.edit')
    ->middleware('Auditee');

Route::put('auditee/authorized-auditors/{id}', [AuditeeAuthorizedAuditorController::class, 'update'])
    ->name('auditee.auditor.update')
    ->middleware('Auditee');

Route::delete('auditee/authorized-auditors/{id}', [AuditeeAuthorizedAuditorController::class, 'delete'])
    ->name('auditee.auditor.delete')
    ->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/authorized-auditors/{id}', [AuditeeAuthorizedAuditorController::class, 'show'])
    ->name('auditee.auditor.single')
    ->middleware('Auditee');

// ========= Print & Download ======================================

Route::get('auditee/authorized-auditors/{id}/print', [AuditeeAuthorizedAuditorController::class, 'print'])
    ->name('auditee.auditor.print')
    ->middleware('Auditee');

Route::get('auditee/authorized-auditors/{id}/download', [AuditeeAuthorizedAuditorController::class, 'download'])
    ->name('auditee.auditor.download')
    ->middleware('Auditee');

// ========= Import ================================================

Route::post('auditee/authorized-auditors/import', [AuditeeAuthorizedAuditorController::class, 'import'])
    ->name('auditee.auditor.import')
    ->middleware('Auditee');









// ========= Training Record - SA (Auditee) ===========================================

Route::get('auditee/training-record-sa/create', [AuditeeTrainingRecordSaController::class, 'create'])
    ->name('auditee.training_sa.create')
    ->middleware('Auditee');

Route::post('auditee/training-record-sa/store', [AuditeeTrainingRecordSaController::class, 'store'])
    ->name('auditee.training_sa.store')
    ->middleware('Auditee');

Route::get('auditee/training-record-sa/{id}/edit', [AuditeeTrainingRecordSaController::class, 'edit'])
    ->name('auditee.training_sa.edit')
    ->middleware('Auditee');

Route::put('auditee/training-record-sa/{id}', [AuditeeTrainingRecordSaController::class, 'update'])
    ->name('auditee.training_sa.update')
    ->middleware('Auditee');

Route::delete('auditee/training-record-sa/{id}', [AuditeeTrainingRecordSaController::class, 'delete'])
    ->name('auditee.training_sa.delete')
    ->middleware('Auditee');

// PUT THIS LAST
Route::get('auditee/training-record-sa/{id}', [AuditeeTrainingRecordSaController::class, 'show'])
    ->name('auditee.training_sa.single')
    ->middleware('Auditee');

// ========= Import ================================================

Route::post('auditee/training-record-sa/import', [AuditeeTrainingRecordSaController::class, 'import'])
    ->name('auditee.training_sa.import')
    ->middleware('Auditee');
