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


// Route::resource('contract_types', ContractTypeController::class);
// Route::resource('media_contacts', MediaContactController::class);
Route::apiResource('professors', ProfessorController::class);
// Route::resource('academical_work_experiences', AcademicalWorkExperienceController::class);