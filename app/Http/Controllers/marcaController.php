<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Marca;
use Illuminate\Support\Facades\Validator;

class marcaController extends Controller
{
    public function listarMarcas(){
        
        $marcas = Marca::all();

         if ($marcas->isEmpty()){
            $data = [
                'mensaje' => 'No se encontraron registros',
                'status' => 404
             ];
             return response()->json($data , 404);
        }
        $marcasDetalle = $marcas->map(function ($marca) {
            return [
                'id' => $marca->id,
                'nom_marca' => $marca->nom_marca
            ];
        });

        $data = [
            'marcas' => $marcasDetalle,
            'status' => 200
        ];

        return response()->json($data, 200);
        
    }

    public function guardarMarca(Request $request){

        $validator = Validator::make($request->all(), [
            'nom_marca' => 'required|max:35|unique:marcas'
        ]);

        if ($validator->fails()){
            $data = [
                'mensaje' => 'Error en la validacion de datos',
                'errores' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $marca = Marca::create([
            'nom_marca' => $request->nom_marca
        ]); 

        if(!$marca){
            $data = [
                'mensaje' => 'Error al crear Marca',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'marca' => $marca,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
}
