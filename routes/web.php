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
use App\Http\Controllers\users\ActivationController;
use App\Http\Controllers\admin\QualityAuditorController;
use App\Http\Controllers\admin\RampInspectionController;
use App\Http\Controllers\admin\TrainingRecordSaController;
use App\Http\Controllers\admin\AuthorizedAuditorController;

use App\Http\Controllers\admin\TrainingRecordSESController;
use App\Http\Controllers\admin\QualifyingMechanicController;
use App\Http\Controllers\admin\StoreQualityInspectorController;
use App\Http\Controllers\admin\AircraftCertifyingStaffController;
use App\Http\Controllers\admin\ComponentCertifyingStaffController;
use App\Http\Controllers\admin\AuthorizedStandardLabPersonnelController;





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


//  ========= import and  export  excell sheets ===========================================

// Route::get('/qa/users/export-excel', [ExcelController::class, 'export'])->name('qa.users.export.excel')->middleware(['web', 'Qa']);

// Route::post('/qa/users/import-excel', [ExcelController::class, 'import'])->name('qa.users.import.excel')->middleware(['web', 'Qa']);




// ========= Manuals ===========================================

Route::get('/admin/document/manual/view', [ManualController::class, 'view'])->name('admin.document.manual.view')->middleware('Admin');

Route::get('/admin/document/manual/form', [ManualController::class, 'form'])->name('admin.document.manual.form')->middleware('Admin');

Route::post('/admin/document/manual/create', [ManualController::class, 'create'])->name('admin.document.manual.create')->middleware('Admin');

Route::get('/admin/document/manual/edit/{id}', [ManualController::class, 'edit'])->name('admin.document.manual.edit')->middleware('Admin');

Route::post('/admin/document/manual/update/{id}', [ManualController::class, 'update'])->name('admin.document.manual.update')->middleware('Admin');

Route::get('/admin/document/manual/delete/{id}', [ManualController::class, 'delete'])->name('admin.document.manual.delete')->middleware('Admin');






// ========= Ramp Inspection ===========================================

Route::get('/admin/rampinspection/view', [RampInspectionController::class, 'view'])->name('admin.rampinspection.view')->middleware('Admin');

Route::get('/admin/rampinspection/form', [RampInspectionController::class, 'form'])->name('admin.rampinspection.form')->middleware('Admin');

Route::post('/admin/rampinspection/create', [RampInspectionController::class, 'create'])->name('admin.rampinspection.create')->middleware('Admin');

Route::get('/admin/rampinspection/edit/{id}', [RampInspectionController::class, 'edit'])->name('admin.rampinspection.edit')->middleware('Admin');

Route::post('/admin/rampinspection/update/{id}', [RampInspectionController::class, 'update'])->name('admin.rampinspection.update')->middleware('Admin');

Route::get('/admin/rampinspection/delete/{id}', [RampInspectionController::class, 'delete'])->name('admin.rampinspection.delete')->middleware('Admin');


// ========= Ramp Inspection Findings ===========================================

Route::get('/admin/rampinspection/finding/view/{id}', [RampInspectionController::class, 'findingView'])->name('admin.rampinspection.finding.view')->middleware('Admin');

Route::get('/admin/rampinspection/finding/form/{id}', [RampInspectionController::class, 'findingForm'])->name('admin.rampinspection.finding.form')->middleware('Admin');

Route::post('/admin/rampinspection/finding/create', [RampInspectionController::class, 'findingCreate'])->name('admin.rampinspection.finding.create')->middleware('Admin');

Route::get('/admin/rampinspection/finding/edit/{id}', [RampInspectionController::class, 'findingEdit'])->name('admin.rampinspection.finding.edit')->middleware('Admin');

Route::post('/admin/rampinspection/finding/update/{id}', [RampInspectionController::class, 'findingUpdate'])->name('admin.rampinspection.finding.update')->middleware('Admin');

Route::get('/admin/rampinspection/finding/delete/{id}', [RampInspectionController::class, 'findingDelete'])->name('admin.rampinspection.finding.delete')->middleware('Admin');


// ========= Ramp Inspection Reply ===========================================

Route::get('/admin/rampinspection/finding/reply/view/{id}', [RampInspectionController::class, 'replyView'])->name('admin.rampinspection.finding.reply.view')->middleware('Admin');

Route::get('/admin/rampinspection/finding/reply/form/{id}', [RampInspectionController::class, 'replyForm'])->name('admin.rampinspection.finding.reply.form')->middleware('Admin');

Route::post('/admin/rampinspection/finding/reply/create', [RampInspectionController::class, 'replyCreate'])->name('admin.rampinspection.finding.reply.create')->middleware('Admin');

Route::get('/admin/rampinspection/finding/reply/edit/{id}', [RampInspectionController::class, 'replyEdit'])->name('admin.rampinspection.finding.reply.edit')->middleware('Admin');

Route::post('/admin/rampinspection/finding/reply/update/{id}', [RampInspectionController::class, 'replyUpdate'])->name('admin.rampinspection.finding.reply.update')->middleware('Admin');

Route::get('/admin/rampinspection/finding/reply/delete/{id}', [RampInspectionController::class, 'replyDelete'])->name('admin.rampinspection.finding.reply.delete')->middleware('Admin');





// ========= Audit ===========================================

Route::get('/admin/audit/view', [AuditController::class, 'view'])->name('admin.audit.view')->middleware('Admin');

Route::get('/admin/audit/form', [AuditController::class, 'form'])->name('admin.audit.form')->middleware('Admin');

Route::post('/admin/audit/create', [AuditController::class, 'create'])->name('admin.audit.create')->middleware('Admin');

Route::get('/admin/audit/edit/{id}', [AuditController::class, 'edit'])->name('admin.audit.edit')->middleware('Admin');

Route::post('/admin/audit/update/{id}', [AuditController::class, 'update'])->name('admin.audit.update')->middleware('Admin');

Route::get('/admin/audit/delete/{id}', [AuditController::class, 'delete'])->name('admin.audit.delete')->middleware('Admin');


// ========= Audit Findings ===========================================

Route::get('/admin/audit/finding/view/{id}', [AuditController::class, 'findingView'])->name('admin.audit.finding.view')->middleware('Admin');

Route::get('/admin/audit/finding/form/{id}', [AuditController::class, 'findingForm'])->name('admin.audit.finding.form')->middleware('Admin');

Route::post('/admin/audit/finding/create', [AuditController::class, 'findingCreate'])->name('admin.audit.finding.create')->middleware('Admin');

Route::get('/admin/audit/finding/edit/{id}', [AuditController::class, 'findingEdit'])->name('admin.audit.finding.edit')->middleware('Admin');

Route::post('/admin/audit/finding/update/{id}', [AuditController::class, 'findingUpdate'])->name('admin.audit.finding.update')->middleware('Admin');

Route::get('/admin/audit/finding/delete/{id}', [AuditController::class, 'findingDelete'])->name('admin.audit.finding.delete')->middleware('Admin');


// ========= Audit Reply ===========================================

Route::get('/admin/audit/finding/reply/view/{id}', [AuditController::class, 'replyView'])->name('admin.audit.finding.reply.view')->middleware('Admin');

Route::get('/admin/audit/finding/reply/form/{id}', [AuditController::class, 'replyForm'])->name('admin.audit.finding.reply.form')->middleware('Admin');

Route::post('/admin/audit/finding/reply/create', [AuditController::class, 'replyCreate'])->name('admin.audit.finding.reply.create')->middleware('Admin');

Route::get('/admin/audit/finding/reply/edit/{id}', [AuditController::class, 'replyEdit'])->name('admin.audit.finding.reply.edit')->middleware('Admin');

Route::post('/admin/audit/finding/reply/update/{id}', [AuditController::class, 'replyUpdate'])->name('admin.audit.finding.reply.update')->middleware('Admin');

Route::get('/admin/audit/finding/reply/delete/{id}', [AuditController::class, 'replyDelete'])->name('admin.audit.finding.reply.delete')->middleware('Admin');



// =========================== Training & Auth ===========================================

// =========================== SES ===========================================

// ========= Staff ===========================================

Route::get('/admin/training/view', [TrainingController::class, 'view'])->name('admin.training.view')->middleware('Admin');

Route::get('/admin/staff/form', [TrainingController::class, 'form'])->name('admin.staff.form')->middleware('Admin');

Route::post('/admin/staff/create', [TrainingController::class, 'create'])->name('admin.staff.create')->middleware('Admin');

Route::get('/admin/staff/edit/{id}', [TrainingController::class, 'edit'])->name('admin.staff.edit')->middleware('Admin');

Route::put('/admin/staff/update/{id}', [TrainingController::class, 'update'])->name('admin.staff.update')->middleware('Admin');

Route::get('/admin/staff/delete/{id}', [TrainingController::class, 'delete'])->name('admin.staff.delete')->middleware('Admin');

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



// remove previous pictures when updating
// also delete picture along with record
