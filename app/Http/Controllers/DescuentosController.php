<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Descuentos;


use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class DescuentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descuentos = Descuentos::all();
        return response()->json($descuentos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Crear el regla de validacion
        $reglas = [
            'porcentaje' => 'required|numeric|between:0,100|decimal:1',
        ];

        // Crear el validador
        $validador = Validator::make($request->all(), $reglas);

        if ($validador->fails()) {
            return response()->json([
                'error' => 'Error de validación en la petición',
                'mensajes' => $validador->errors()
            ], 422);
        }

        try {
            $descuentos = new Descuentos();

            $descuentos->porcentaje = $request->porcentaje;

            $descuentos->save();
            return response()->json([
                'mensaje' => 'El ' . $descuentos->porcentaje . ' % se ha guardado en la DB',
                'data' => $descuentos
            ], 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al guardar en la base de datos',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $descuentos = Descuentos::findOrFail($id);

        try {
            return response()->json([
                'mensaje' => 'Se encontró el descuento del ' . $descuentos->porcentaje. ' %',
                'data' => $descuentos
            ], 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'No se encontró el descuento',
                'mensaje' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reglas = [
            'porcentaje' => 'required|numeric|between:0,100|decimal:1',
        ];

        // Crear el validador
        $validador = Validator::make($request->all(), $reglas);

        if ($validador->fails()) {
            return response()->json([
                'error' => 'Error de validación en la petición',
                'mensajes' => $validador->errors()
            ], 422);
        }

        try{
            $descuentos = Descuentos::findOrFail($id);
            $descuentos->porcentaje = $request->porcentaje;
    
            $descuentos->save();
            return response()->json([
                'mensaje' =>'Se ha actualizado el descuento de '.$descuentos->porcentaje.' %',
                'data' => $descuentos
                ],201,[],JSON_UNESCAPED_UNICODE);
        }catch(\Exception $e){
            return response()->json([
                'mensaje' => 'No se actualizo el descuento',
                'mensaje' => $e->getMessage()
            ],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        try{
            $descuentos = Descuentos::findOrFail($id);
            $descuentos->delete();
            return response()->json([
                'message' => 'Se ha eliminado el descuento '. $descuentos->porcentaje .' %',
                'data' => $descuentos
            ],200,[],JSON_UNESCAPED_UNICODE);
        }catch(\Exception $e){
            return response()->json([
                'mensaje' => 'No se encontro el descuento para eliminar',
                'mensaje' => $e->getMessage()
            ],500);
        }
    }
}
