<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;

class ProfessorController extends Controller
{
    public function index()
    {
        try{
            $professors = Professor::all();
            return ApiResponse::success('Lista de Profesores', 200, $professors);
        } catch(Exception $e){
            return ApiResponse::error('Ocurrio un error: '.$e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'dni' => 'required|unique:professors',
                'lastName' => 'required|string|max:40',
                'motherLastName' => 'required|string|max:40',
                'firstName' => 'required|string|max:40',
                // 'birthDate' => 'required|date',
                'gender'=> 'required', 
                'nationality' => 'required', 
                'ubigeoCode' => 'required',
                // 'mediaContactId'
            ]);

            $professor = Professor::create($request->all());
            return ApiREsponse::success('Profesor creado exitosamente', 201, $professor);
        } catch(ValidationException $e){
            return ApiResponse::error('Error de validacion: '.$e->getMessage(), 422);
        }
    }

    public function show($id)
    {
        try{
            $professor = Professor::findOrFail($id);
            return ApiResponse::success('Profesor obtenido exitosamente', 200, $professor);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Profesor no encontrado', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $professor = Professor::findOrFail($id);
            $request->validate([
                'dni' => ['required', Rule::unique('professors')->ignore($professor)],
                'lastName' => 'required|string|max:40',
                'motherLastName' => 'required|string|max:40',
                'firstName' => 'required|string|max:40',
                // 'birthDate' => 'required|date',
                'gender'=> 'required', 
                'nationality' => 'required', 
                'ubigeoCode' => 'required',
                // 'mediaContactId'
            ]);

            $professor -> update($request->all());
            return ApiREsponse::success('Profesor actualizado exitosamente', 200, $professor);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Profesor no encontrado: '.$e->getMessage(), 404);
        } catch(Exception $e){
            return ApiResponse::error('Error: '.$e-> getMessage(), 422);
        }
    }

    public function destroy($id)
    {
        try{
            $professor = Professor::findOrFail($id);
            $professor->delete();
            return ApiResponse::success('Profesor eliminado exitosamente', 200);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Profesor no encontrado: '.$e->getMessage(), 404);
        }
    }
}
