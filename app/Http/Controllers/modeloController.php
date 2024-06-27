<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Modelo;
use App\Models\Marca;

use Illuminate\Support\Facades\Validator;

class modeloController extends Controller
{

    public function listarModelos(){
        
        $modelos = Modelo::all();

         if ($modelos->isEmpty()){
            $data = [
                'message' => 'No se encontraron registros',
                'status' => 404
             ];
             return response()->json($data , 404);
         }
        
        $data = [
            'modelos' => $modelos,
            'status' => 200
        ];

        return response()->json($data, 200);
        
    }

    public function guardarModelo(Request $request){

        $validator = Validator::make($request->all(), [
            'nom_modelo' => 'required|max:35|unique:modelos',
            'marca_id' => 'required|exists:marcas,id',
            
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $modelo = Modelo::create([
            'nom_modelo' => $request->nom_modelo,
            'marca_id' => $request->marca_id,
           
        ]); 

        if(!$modelo){
            $data = [
                'message' => 'Error al crear Modelo',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'modelo' => $modelo,
            'status' => 201 
        ];

        return response()->json($data, 201);


    }

    public function modelosPorMarca($nom_marca) {
        
        $marca = Marca::where('nom_marca', $nom_marca)->first();
    
        if (!$marca) {
            $data = [
                'message' => 'Marca no encontrada',
                'status' => 404
            ];
    
            return response()->json($data, 404);
        }
    
        $modelos = Modelo::where('marca_id', $marca->id)->with('marca')->get();
    
        if ($modelos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron modelos para la marca indicada',
                'status' => 404
            ];
    
            return response()->json($data, 404);
        }

        $modelosDetalle = $modelos->map(function ($modelo) {
                    return [
                        'id' => $modelo->id,
                        'nom_modelo' => $modelo->nom_modelo,
                        'nom_marca' => $modelo->marca->nom_marca,
                    ];
                });
        
        $data = [
            'modelos' => $modelosDetalle,
            'status' => 200
        ];
    
        return response()->json($data, 200);
    }
}
