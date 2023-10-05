<?php

namespace App\Http\Controllers;

use App\Models\ContractType;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;

class ContractTypeController extends Controller
{
    public function index()
    {
        try{
            $contract_types = ContractType::all();
            return ApiResponse::success('Lista de Tipos de contrato', 200, $contract_types);
        } catch(Exception $e){
            return ApiResponse::error('Ocurrio un error: '.$e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'type' => 'required'
            ]);

            $contract_type = ContractType::create($request->all());
            return ApiResponse::success('Tipo de contrato creado exitosamente', 201, $contract_type);
        } catch(ValidationException $e){
            return ApiResponse::error('Error de validacion: '.$e->getMessage(), 422);
        }
    }

    public function show($id)
    {
        try{
            $contract_type = ContractType::findOrFail($id);
            return ApiResponse::success('Tipo de contrato obtenido exitosamente', 200, $contract_type);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Tipo de contrato no encontrado', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $contract_type = ContractType::findOrFail($id);
            $request->validate([
                'type' => 'required'
            ]);

            $contract_type -> update($request->all());
            return ApiResponse::success('Tipo de contrato actualizado correctamente', 200, $contract_type);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Tipo de contrato no encontrado: '.$e->getMessage(), 404);
        } catch(Exception $e){
            return ApiResponse::error('Error: '.$e-> getMessage(), 422);
        }
    }

    public function destroy($id)
    {
        try{
            $contract_type = ContractType::findOrFail($id);
            $contract_type -> delete();
            return ApiResponse::success('Tipo de contrato eliminado exitosamente', 200);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Tipo de contrato no encontrado: '.$e->getMessage(), 404);
        }
    }
}
