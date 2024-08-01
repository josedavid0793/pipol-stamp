<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Tallas;

use Illuminate\Http\Request;

class TallasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tallas = Tallas::all();
        return response()->json($tallas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //regla de validación
        $reglas = [
            'talla' => 'required|string|max:100',
            'stock' => 'string|max:100',
        ];

        $validador = Validator::make($request->all(), $reglas);

        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()

            ], 422);
        }

        try {
            $tallas = new Tallas();
            $tallas->talla = $request->talla;
            $tallas->stock = $request->stock;
            $tallas->save();
            return response()->json([
                'mensaje' => 'Se ha guardado la talla ' . $tallas->talla . ' en la base de datos',
                'data' => $tallas,
            ], 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ha ocurrido un error al agregar la talla en la base de datos',
                'mensaje' => $e->getMessage()
            ]);
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
        $tallas = Tallas::findOrFail($id);
        try {
            return response()->json([
                'mensaje' => 'Se consulto la talla ' . $tallas->talla . ' de la base de datos',
                'data' => $tallas
            ], 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se obtuvo la talla solicitada',
                'mensaje' => $e->getMessage()
            ]);
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
            'talla' => 'required|string|max:100',
            'stock' => 'string|max:100',
        ];

        $validador = Validator::make($request->all(), $reglas);

        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ],422);
        }
        try {
            $tallas = Tallas::findOrFail($id);
            $tallas->talla = $request->talla;
            $tallas->stock = $request->stock;
            $tallas->save();
            return response()->json([
                'mensaje' => 'Se ha actualizado la talla ' . $tallas->talla . ' en la base de datos',
                'data' => $tallas
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Se presento un error al actualizar la talla consultada',
                'mensaje' => $e->getMessage()
            ], 500);
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
        try {
            $tallas = Tallas::findOrFail($id);
            $tallas->delete();
            return response()->json([
                'mensaje' => 'Se ha eliminado la talla ' . $tallas->talla . ' de la base de datos',
                'data' => $tallas
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se elimino la talla deseada',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }
}
