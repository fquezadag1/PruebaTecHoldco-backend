<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bodega;
use Illuminate\Support\Facades\Validator;

class bodegaController extends Controller
{
    public function listarBodegas(){
        
        $bodegas = Bodega::all();

         if ($bodegas->isEmpty()){
            $data = [
                'message' => 'No se encontraron registros',
                'status' => 200
             ];
             return response()->json($data , 404);
         }

         $data = [
            'bodegas' => $bodegas,
            'status' => 200
        ];

        return response()->json($data, 200);
        
    }

    public function guardarBodega(Request $request){

        $validator = Validator::make($request->all(), [
            'nom_bodega' => 'required|max:35|unique:bodegas'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $bodega = Bodega::create([
            'nom_bodega' => $request->nom_bodega
        ]); 

        if(!$bodega){
            $data = [
                'message' => 'Error al crear Bodega',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'bodega' => $bodega,
            'status' => 201 
        ];

        return response()->json($data, 201);
    }
}
