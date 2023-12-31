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
            return ApiResponse::success('Lista de ProfesorEZ', 200, $professors);
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
                'birthDate' => 'required|date',
                'gender'=> 'required', 
                'nationality' => 'required|string|max:3', 
                'ubigeoCode' => 'required',
                'mediaContactId'=> 'required|exists:media_contacts,id'
                
            ]);

            $professor = Professor::create($request->all());
            return ApiResponse::success('Profesor creado exitosamente', 201, $professor);
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
                'birthDate' => 'required|date',
                'gender'=> 'required', 
                'nationality' => 'required', 
                'ubigeoCode' => 'required',
                'mediaContactId'=> 'required|exists:media_contacts,id'
            ]);

            $professor -> update($request->all());
            return ApiResponse::success('Profesor actualizado exitosamente', 200, $professor);
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




    public function updateAttributee(Request $request, $id)
{
    try {
        $professor = Professor::findOrFail($id);

        $request->validate([
            'dni' => [ Rule::unique('professors')->ignore($professor)],
            'lastName' => 'string|max:40',
            'motherLastName' => 'string|max:40',
            'firstName' => 'string|max:40',
            'birthDate' => 'date',
            'gender'=> 'string|size:1', 
            'nationality' => 'string|size:3', 
            'ubigeoCode' => 'string|size:6',
            'mediaContactId'=> 'exists:media_contacts,id'
        ]);

        $dataToUpdate = $request->only([
            'dni', 'lastName', 'motherLastName', 'firstName', 
            'birthDate', 'gender', 'nationality', 'ubigeoCode', 'mediaContactId'
        ]);

        $professor->update($dataToUpdate);

        return ApiResponse::success('Profesor actualizado exitosamente', 200, $professor);
    } catch (ModelNotFoundException $e) {
        return ApiResponse::error('Profesor no encontrado: '.$e->getMessage(), 404);
    } catch (Exception $e) {
        return ApiResponse::error('Error: '.$e->getMessage(), 422);
    }
}



    public function aeaman($id)
    {
        try{
            $professor = Professor::with('academical_work_experiences')->findOrFail($id)->get();
            return ApiResponse::success('Profesor y lista de experiencia', 200, $professor);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Profesor no encontrado: ', 404);
        }
    }
}
