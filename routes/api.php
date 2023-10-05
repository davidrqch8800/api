<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\MediaContactController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AcademicalWorkExperienceController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('contract_types', ContractTypeController::class);
// Route::resource('media_contacts', MediaContactController::class);
Route::apiResource('professors', ProfessorController::class);
Route::apiResource('academical_work_experiences', AcademicalWorkExperienceController::class);
Route::apiResource('updateLastName', ProfessorController::class);
// Route::apiResource('professors/updateMotherLastName', ProfessorController::class);
// Route::apiResource('professors/updateFirstName', ProfessorController::class);
// // Route::apiResource('professors/{id}/updateBirthDate', [ProfessorController::class, 'updateBirthDate'])->name('professors.updateBirthDate');
// Route::apiResource('professors/updateNationality', ProfessorController::class);
// Route::apiResource('professors/updateUbigeoCode', ProfessorController::class);
// Route::apiResource('professors/updateGender', ProfessorController::class);