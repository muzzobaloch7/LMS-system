<?php

use App\Models\ResultAdmin;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndoxController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\LoginSignupController;
use App\Http\Controllers\ResultAdminController;
use App\Http\Controllers\StudentRecordController;
use App\Http\Controllers\FacultyItServiceController;
use App\Http\Controllers\StudentItServiceController;
use App\Http\Controllers\FacultyRecordController;
// General User Routes
Route::get('/', function () {
    return view('pages.loginindex');
})->name('user.login');

Route::get('/forgot-password' , function(){
    return view('pages.forgot');
})->name('forgot');


Route::post('/' , [UserController::class , 'loginMatch'])->name('loginMatch');
Route::get('logout',[UserController::class,'logout'])->name('logout');

// inbox routes
Route::get('inbox/student',[IndoxController::class, 'index'])->name('inbox');
Route::get('inbox/staff',[IndoxController::class, 'facIndex'])->name('fac-inbox');
Route::post('/inbox/idstore', [IndoxController::class , 'idstore'])->name('inbox.idstore');
Route::post('/inbox/stuitstore', [IndoxController::class , 'stuitstore'])->name('inbox.stuitstore');
Route::post('/inbox/facitstore', [IndoxController::class , 'facitstore'])->name('inbox.facitstore');
Route::post('/inbox/resultstore', [IndoxController::class , 'resultstore'])->name('inbox.resultstore');
Route::delete('/inbox/delete/{id}', [IndoxController::class , 'destroy'])->name('inbox.delete');

// Student General Routes
Route::get('/student', [StudentRecordController::class , 'studentView'],[StudentItServiceController::class , 'studentView'])->name('student');
Route::get('/staff', function () {
    return view('pages.fac-welcome');
})->name('staff');

// Student ID Card Services Routes
Route::resource('studentrecords', StudentRecordController::class);
Route::post('studentrecords', [StudentRecordController::class , 'store'])->name('studentrecords.store');
Route::get('studentrecords/create', [StudentRecordController::class , 'create'])->name('studentrecords.create');
Route::get('/pending', [StudentRecordController::class , 'pending'])->name('studentrecords.pending')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('/accepted', [StudentRecordController::class , 'accepted'])->name('studentrecords.accepted')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('/sendMessage/{id}', [StudentRecordController::class , 'sendMessage'])->name('studentrecords.sendMessage')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('/studentrecords/pending/search', [StudentRecordController::class, 'psearch'])->name('studentrecords.psearch');
Route::get('/studentrecords/accepted/search', [StudentRecordController::class, 'asearch'])->name('studentrecords.asearch');

// Faculty ID Card Services Routes
Route::resource('facultyrecords', FacultyRecordController::class);  
Route::post('facultyrecords', [FacultyRecordController::class , 'store'])->name('facultyrecords.store');
Route::get('facultyrecords/create', [FacultyRecordController::class , 'create'])->name('facultyrecords.create');
Route::get('/facultyrecords/pending', [FacultyRecordController::class, 'pending'])->name('facultyrecords.pending')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('/facultyrecords/accepted', [FacultyRecordController::class, 'accepted'])->name('facultyrecords.accepted')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('/sendMessage/{id}', [FacultyRecordController::class , 'sendMessage'])->name('facultyrecords.sendMessage')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('/facultyrecords/pending/search', [FacultyRecordController::class, 'psearch'])->name('facultyrecords.psearch');
Route::get('/facultyrecords/accepted/search', [FacultyRecordController::class, 'asearch'])->name('facultyrecords.asearch');


// Student IT Services Routes
Route::resource('student-it-services',StudentItServiceController::class);
Route::post('student-it-services',[StudentItServiceController::class , 'store'])->name('student-it-services.store');
Route::get('student-it-services/create',[StudentItServiceController::class , 'create'])->name('student-it-services.create');
Route::get('student-it-credential',[StudentItServiceController::class , 'viewCredentials'])->name('student-it-credential');
Route::get('studentitservices/pending', [StudentItServiceController::class, 'pending'])->name('student-it-services.pending')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('studentitservices/accepted', [StudentItServiceController::class, 'accepted'])->name('student-it-services.accepted')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('/student-it-services/pending/search', [StudentItServiceController::class, 'psearch'])->name('student-it-services.psearch');
Route::get('/student-it-services/accepted/search', [StudentItServiceController::class, 'asearch'])->name('student-it-services.asearch');

// Faculty IT Services Routes
Route::resource('faculty-it-services', FacultyItServiceController::class);
Route::post('faculty-it-services',[FacultyItServiceController::class , 'store'])->name('faculty-it-services.store');
Route::get('faculty-it-services/create',[FacultyItServiceController::class , 'create'])->name('faculty-it-services.create');
Route::get('faculty-it-credential',[FacultyItServiceController::class , 'viewCredentials'])->name('faculty-it-credential');
Route::get('facultyitservices/pending', [FacultyItServiceController::class, 'pending'])->name('faculty-it-services.pending')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('facultyitservices/accepted', [FacultyItServiceController::class, 'accepted'])->name('faculty-it-services.accepted')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('/faculty-it-services/pending/search', [FacultyItServiceController::class, 'psearch'])->name('faculty-it-services.psearch');
Route::get('/faculty-it-services/accepted/search', [FacultyItServiceController::class, 'asearch'])->name('faculty-it-services.asearch');

// IT Services Admin Panel Routes
Route::get('admin-panel/it-services',[AdminPanelController::class , 'itServices'])->name('admin-panel.it-services')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('admin-panel/it-services/faculty-it-services',[FacultyItServiceController::class , 'index'])->name('faculty-it-services.index')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('admin-panel/id-card-services/faculty-it-services/{facultyItService}',[FacultyItServiceController::class , 'show'])->name('faculty-it-services.show')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('admin-panel/id-card-services/faculty-it-services/{facultyItService}',[FacultyItServiceController::class , 'accept'])->name('faculty-it-services.accept')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::post('/faculty-it-services/{id}/store-credentials', [FacultyItServiceController::class, 'storeCredentials'])->name('faculty-it-services.store-credentials')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('/sendmessage-faculty-it-services/{id}',[FacultyItServiceController::class , 'sendMessage'])->name('faculty-it-services.sendMessage')->middleware('IsUserValid:itservicesadmin,mainadmin');

// Admin Student IT Services Routes
Route::get('admin-panel/it-services/student-it-services',[StudentItServiceController::class , 'index'])->name('student-it-services.index')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('/itservice-admin/{user}/edit', [StudentItServiceController::class, 'edit'])->name('itservice-admin-panel.editUser')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::put('/itservice-admin/{user}', [StudentItServiceController::class, 'update'])->name('itservice-admin-panel.updateUser')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('admin-panel/id-card-services/student-it-services/{studentItService}',[StudentItServiceController::class , 'accept'])->name('student-it-services.accept')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('admin-panel/it-services/student-it-services/{studentItService}',[StudentItServiceController::class , 'show'])->name('student-it-services.show')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::post('/student-it-services/{id}/store-credentials', [StudentItServiceController::class, 'storeCredentials'])->name('student-it-services.store-credentials')->middleware('IsUserValid:itservicesadmin,mainadmin');
Route::get('/sendmessage-student-it-services/{id}',[StudentItServiceController::class , 'sendMessage'])->name('student-it-services.sendMessage')->middleware('IsUserValid:itservicesadmin,mainadmin');

// Admin Student ID Card Services Routes
Route::get('admin-panel/id-card-services',[AdminPanelController::class , 'idCardServices'])->name('admin-panel.id-card-services')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('admin-panel/id-card-services/studentrecords', [StudentRecordController::class , 'index'])->name('studentrecords.index')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('/idcard-admin/{user}/edit', [StudentRecordController::class, 'edit'])->name('idcard-admin-panel.editUser')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::put('/idcard-admin/{user}', [StudentRecordController::class, 'update'])->name('idcard-admin-panel.updateUser')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('admin-panel/id-card-services/studentrecords/{studentrecord}', [StudentRecordController::class , 'show'])->name('studentrecords.show')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('admin-panel/id-card-services/studentrecords/{studentrecord}', [StudentRecordController::class , 'accept'])->name('studentrecords.accept')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('admin-panel/id-card-services/facultyrecords/{facultyrecord}', [FacultyRecordController::class , 'show'])->name('facultyrecord.show')->middleware('IsUserValid:idcardadmin,mainadmin');
Route::get('admin-panel/id-card-services/facultyrecords/{facultyrecord}', [FacultyRecordController::class , 'accept'])->name('facultyrecord.accept')->middleware('IsUserValid:idcardadmin,mainadmin');

// Result Admin Routes
Route::get('/result-admin', [ResultAdminController::class, 'index'])->name('result-admin.index')->middleware('IsUserValid:resultadmin,mainadmin');
Route::post('/result-admin', [ResultAdminController::class, 'store'])->name('result-admin.store')->middleware('IsUserValid:resultadmin,mainadmin');
Route::get('/result-admin/create', [ResultAdminController::class, 'create'])->name('result-admin.create');
Route::get('/show-result',[ResultAdminController::class , 'show'])->name('show-result');
Route::get('/result-admin/{result_admin}/edit', [ResultAdminController::class, 'edit'])->name('result-admin.edit')->middleware('IsUserValid:resultadmin,mainadmin');
Route::put('/result-admin/{result_admin}', [ResultAdminController::class, 'update'])->name('result-admin.updateUser')->middleware('IsUserValid:mainadmin,resultadmin');
Route::post('/store-request', [ResultAdminController::class, 'requestResultStore'])->name('storeRequest');
Route::get('/requestresult', [ResultAdminController ::class, 'createForm'])->name('request-result.create');
Route::get('/result-admin-sendMessage', [ResultAdminController::class , 'sendMessage'])->name('result-admin.sendMessage')->middleware('IsUserValid:resultadmin,mainadmin');
// Super Admin Panel Routes
Route::get('admin-panel',[AdminPanelController::class , 'index'])->name('admin-panel.index')->middleware('IsUserValid:mainadmin');
Route::get('admin-panel/idcardadmin',[AdminPanelController::class , 'idCardAdmin'])->name('admin-panel.idadmin')->middleware('IsUserValid:mainadmin');
Route::get('admin-panel/idcardadmin/{id}',[AdminPanelController::class , 'idCardAdminedit'])->name('admin-panel.idadmin.edit')->middleware('IsUserValid:mainadmin');
Route::put('admin-panel/idcardadmin/{id}',[AdminPanelController::class , 'idCardAdminUpdate'])->name('admin-panel.idadmin.update')->middleware('IsUserValid:mainadmin');
Route::delete('admin-panel/idcardadmin/{id}',[AdminPanelController::class , 'idCardAdminDelete'])->name('admin-panel.idadmin.delete')->middleware('IsUserValid:mainadmin');
Route::get('admin-panel/itadmin',[AdminPanelController::class , 'itServicesAdmin'])->name('admin-panel.itadmin')->middleware('IsUserValid:mainadmin');
Route::get('admin-panel/itservicesadmin/{id}',[AdminPanelController::class , 'itservicesAdminedit'])->name('admin-panel.itadmin.edit')->middleware('IsUserValid:mainadmin');
Route::put('admin-panel/itservicesadmin/{id}',[AdminPanelController::class , 'itservicesAdminUpdate'])->name('admin-panel.itadmin.update')->middleware('IsUserValid:mainadmin');
Route::delete('admin-panel/itservicesadmin/{id}',[AdminPanelController::class , 'itServicesAdminDelete'])->name('admin-panel.itadmin.delete')->middleware('IsUserValid:mainadmin');
Route::get('admin-panel/resultadmin',[AdminPanelController::class , 'resultAdmin'])->name('admin-panel.resadmin')->middleware('IsUserValid:mainadmin');
Route::get('admin-panel/resultadmin/{id}',[AdminPanelController::class , 'resultAdminedit'])->name('admin-panel.resultadmin.edit')->middleware('IsUserValid:mainadmin');
Route::put('admin-panel/resultadmin/{id}',[AdminPanelController::class , 'resultAdminUpdate'])->name('admin-panel.resultadmin.update')->middleware('IsUserValid:mainadmin');
Route::delete('admin-panel/resultadmin/{id}',[AdminPanelController::class , 'resultAdminDelete'])->name('admin-panel.resultadmin.delete')->middleware('IsUserValid:mainadmin');
Route::get('admin-panel/create',[AdminPanelController::class , 'addUser'])->name('admin-panel.addUser')->middleware('IsUserValid:mainadmin');
Route::post('admin-panel',[AdminPanelController::class , 'store'])->name('admin-panel.addUser.store')->middleware('IsUserValid:mainadmin');
Route::get('/admin/{user}/edit', [UserController::class, 'edit'])->name('admin-panel.editUser')->middleware('IsUserValid:mainadmin');
Route::put('/admin/{user}', [UserController::class, 'update'])->name('admin-panel.updateUser')->middleware('IsUserValid:mainadmin');
