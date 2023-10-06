<?php

namespace App\Http\Controllers;

use App\Models\MediaContact;
use Illuminate\Http\Request;

use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;

class MediaContactController extends Controller
{
    public function index()
    {
        try{
            $media_contacts = MediaContact::all();
            return ApiResponse::success('Lista de contacto', 200, $media_contacts);
        } catch(Exception $e){
            return ApiResponse::error('Ocurrio un error: '.$e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'address' => 'required|string',
                'email' => 'required|email|unique:media_contacts',
                'phone' => 'required|string|unique:media_contacts',
                'socialMedia' => 'nullable|string',
                'linkSocialNetwork' => 'nullable|string|max:64|unique:media_contacts',
            ]);

            $media_contact = MediaContact::create($request->all());
            return ApiResponse::success('Contacto creado exitosamente', 201, $media_contact);
        } catch(ValidationException $e){
            return ApiResponse::error('Error de validacion: '.$e->getMessage(), 422);
        }
        
    }

    public function show($id)
    {
        try{
            $media_contact = MediaContact::findOrFail($id);
            return ApiResponse::success('Contacto obtenido exitosamente', 200, $media_contact);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('contacto no encontrado', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $media_contact = MediaContact::findOrFail($id);
            $request->validate([
                'address' => 'required|string',
                'email' => ['required|email', Rule::unique('media_contacts')->ignore($media_contact)],
                'phone' => ['required|string', Rule::unique('media_contacts')->ignore($media_contact)],
                'socialMedia' => 'nullable|string',
                'linkSocialNetwork' => 'nullable|string|max:64|unique:media_contacts',
            ]);

            $media_contact -> update($request->all());
            return ApiResponse::success('Contacto actualizado correctamente', 200, $media_contact);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Contacto no encontrado: '.$e->getMessage(), 404);
        } catch(Exception $e){
            return ApiResponse::error('Error: '.$e-> getMessage(), 422);
        }
    }

    public function destroy($id)
    {
        try{
            $media_contact = MediaContact::findOrFail($id);
            $media_contact -> delete();
            return ApiResponse::success('Contacto eliminado exitosamente', 200);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('Contacto no encontrado: '.$e->getMessage(), 404);
        }
    }
}
