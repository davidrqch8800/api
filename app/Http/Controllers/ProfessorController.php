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
                'nationality' => 'required', 
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



    public function experienciaProfessor($id)
    {
        try{
            $professor = Professor::with('academical_work_experiences')->findOrFail($id);
            return ApiResponse::success('Profesor y lista de experiencia', 200, $professor);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Profesor no encontrado: ', 404);
        }
    }




    // public function updateLastName(Request $request, $id)
    // {
    //     try {
    //         $professor = Professor::findOrFail($id);

    //         $request->validate([
    //             'dni' => ['required', Rule::unique('professors')->ignore($professor)],
    //             'lastName' => 'required|string|max:40'
    //         ]);

    //         $professor -> save();

    //         return ApiResponse::success('Profesor actualizado exitosamente', 200, $professor);
    //     } catch (ModelNotFoundException $e) {
    //         return ApiResponse::error('Profesor no encontrado: '.$e->getMessage(), 404);
    //     } catch (Exception $e) {
    //         return ApiResponse::error('Error: '.$e-> getMessage(), 422);
    //     }
    // }

    


    // public function updateMotherLastName(Request $request, $id)
    // {
    //     return $this->updateAttribute($request, $id, 'MotherLastName');
    // }

    // public function updateFirstName(Request $request, $id)
    // {
    //     return $this->updateAttribute($request, $id, 'FirstName');
    // }

    // public function updateBirthDate(Request $request, $id)
    // {
    //     return $this->updateAttribute($request, $id, 'BirthDate');
    // }

    // public function updateNationality(Request $request, $id)
    // {
    //     return $this->updateAttribute($request, $id, 'Nationality');
    // }

    // public function updateUbigeoCode(Request $request, $id)
    // {
    //     return $this->updateAttribute($request, $id, 'UbigeoCode');
    // }

    // public function updateGender(Request $request, $id)
    // {
    //     return $this->updateAttribute($request, $id, 'Gender');
    // }

    // private function updateAttribute(Request $request, $id, $attribute)
    // {
    //     try {
    //         $professor = Professor::findOrFail($id);

    //         $professor->save();

    //         return ApiREsponse::success('Profesor actualizado exitosamente', 200, $professor);
    //     } catch (ModelNotFoundException $e) {
    //         return ApiResponse::error('Profesor no encontrado: '.$e->getMessage(), 404);
    //     } catch (Exception $e) {
    //         return ApiResponse::error('Error: '.$e-> getMessage(), 422);
    //     }
    // }

}
