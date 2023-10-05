<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('contract_types', ContractTypeController::class);
Route::resource('media_contacts', MediaContactController::class);
Route::resource('professors', ProfessorController::class);
Route::resource('academical_work_experiences', AcademicalWorkExperienceController::class);