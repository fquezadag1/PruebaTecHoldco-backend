<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dispositivo;
use Illuminate\Support\Facades\Validator;

use App\Models\Modelo;
use App\Models\Bodega;

class dispositivoController extends Controller
{
    public function listarDispositivos() {

        $dispositivos = Dispositivo::with('modelo.marca', 'bodega')->get();
    
        if ($dispositivos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron registros',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    
        $dispositivosDetalle = $dispositivos->map(function ($dispositivo) {
            return [
                'id' => $dispositivo->id,
                'nom_dispositivo' => $dispositivo->nom_dispositivo,
                'nom_modelo' => $dispositivo->modelo->nom_modelo,
                'nom_marca' => $dispositivo->modelo->marca->nom_marca,
                'nom_bodega' => $dispositivo->bodega->nom_bodega
            ];
        });
    
        $data = [
            'dispositivos' => $dispositivosDetalle,
            'status' => 200
        ];
    
        return response()->json($data, 200);
    }

    public function guardarDispositivo(Request $request){

        $validator = Validator::make($request->all(), [
            'nom_dispositivo' => 'required|max:35|unique:dispositivos',
            'modelo_id' => 'required',
            'bodega_id' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $dispositivo = Dispositivo::create([
            'nom_dispositivo' => $request->nom_dispositivo,
            'modelo_id' => $request->modelo_id,
            'bodega_id' => $request->bodega_id
        ]);

        if(!$dispositivo){
            $data = [
                'message' => 'Error al crear Dispositivo',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'dispositivo' => $dispositivo,
            'status' => 201 
        ];

        return response()->json($data, 201);
    }

    public function dispositivosPorBodega($bodega_id) {
       
        $dipostivos = Dispositivo::where('bodega_id', $bodega_id)->get();
    
        if($dipostivos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron dispositivos en la bodega indicada',
                'status' => 404
            ];
    
            return response()->json($data, 404);
        }
        
        $data = [
            'dispositivos' => $dipostivos,
            'status' => 200
        ];
    
        return response()->json($data, 200);
    }

    public function dispositivosPorModelo($nom_modelo) {
        
        $modelo = Modelo::where('nom_modelo', $nom_modelo)->first();
    
        if (!$modelo) {
            $data = [
                'message' => 'Modelo no encontrado',
                'status' => 404
            ];
    
            return response()->json($data, 404);
        }
    
        $dispositivos = Dispositivo::where('modelo_id', $modelo->id)
                                   ->with('bodega', 'modelo.marca')
                                   ->get();
    
        if ($dispositivos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron dispositivos para el Modelo indicado',
                'status' => 404
            ];
    
            return response()->json($data, 404);
        }
    
        $dispositivosDetalle = $dispositivos->map(function ($dispositivo) {
            return [
                'id' => $dispositivo->id,
                'nom_dispositivo' => $dispositivo->nom_dispositivo,
                'nom_modelo' => $dispositivo->modelo->nom_modelo,
                'nom_marca' => $dispositivo->modelo->marca->nom_marca,
                'nom_bodega' => $dispositivo->bodega->nom_bodega
            ];
        });
    
        $data = [
            'dispositivos' => $dispositivosDetalle,
            'status' => 200
        ];
    
        return response()->json($data, 200);
    }
}
