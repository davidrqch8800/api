<?php

namespace App\Http\Controllers;

use App\Models\AcademicalWorkExperience;
use Illuminate\Http\Request;

use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;


class AcademicalWorkExperienceController extends Controller
{
    public function index()
    {
        try{
            $academical_work_experiences = AcademicalWorkExperience::all();
            return ApiResponse::success('Lista de Experiencia laboral', 200, $academical_work_experiences);
        } catch(Exception $e){
            return ApiResponse::error('Error al obtener la lista de experiencia laboral: '.$e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $request -> validate([
                'institution' => 'required|string|max:256',
                'typeInstitution' => 'nullable|string|size:3',
                'position' => 'required|string|max:64',
                'typePosition' => 'nullable|string|size:3',
                'startedAt' => 'required|date',
                'endedAt' => 'required|date',
                'contractTypeId' => 'required|exists:contract_types,id',
                'professorId' => 'required|exists:professors,id', 
            ]);
            $academical_work_experience = AcademicalWorkExperience::create($request->all());
            return ApiResponse::success('Experiencia laboral creado exitosamente', 201, $academical_work_experience);
        } catch(ValidationException $e){
            return ApiResponse::error('Error de validacion: '.$e->getMessage(), 422);
        }
    }

    public function show($id)
    {
        try{
            //$academical_work_experience = AcademicalWorkExperience::with('professor')->findOrFail($id);
            $academical_work_experience = AcademicalWorkExperience::findOrFail($id);
            return ApiResponse::success('Experiencia laboral obtenido exitosamente', 200, $academical_work_experience);
        } catch(ModelnotFoundException $e){
            return ApiResponse::error('Experiencia laboral no encontrado', 404);
        }
    }

    public function update(Request $request, $id)//AcademicalWorkExperience $academicalWorkExperience
    {
        try{
            $academical_work_experience = AcademicalWorkExperience::findOrFail($id);
            $request -> validate([
                'institution' => 'required|string|max:256',
                'typeInstitution' => 'nullable|string|size:3',
                'position' => 'required|string|max:64',
                'typePosition' => 'nullable|string|size:3',
                'startedAt' => 'required|date',
                'endedAt' => 'required|date',
                'contractTypeId' => 'required|exists:contract_types,id',
                'professorId' => 'required|exists:professors,id', 
            ]);
            $academical_work_experience -> update($request->all());
            return ApiResponse::success('Experiencia laboral actualizado exitosamente', 200, $academical_work_experience);
        } catch(ValidationException $e){
            return ApiResponse::error('Error de validacion: '.$e->getMessage(), 422);
        }  catch(ModelNotFoundException $e){
            return ApiResponse::error('Experiencia laboral no encontrado: ', 404);
        }
    }

    public function destroy($id)
    {
        try{
            $academical_work_experience = AcademicalWorkExperience::findOrFail($id);
            $academical_work_experience->delete();
            return ApiResponse::success('Experiencia laboral eliminado exitosamente', 200);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Experiencia laboral no encontrado', 404);
        }
    }
}
