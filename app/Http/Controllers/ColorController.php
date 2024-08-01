<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Colores;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colores = Colores::all();
        return response()->json([$colores, 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'color' => 'required|string|max:200',
        ];
        $validador = Validator::make($request->all(), $reglas);

        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ], 422);
        }
        try {
            $colores = new Colores();
            $colores->color = $request->color;
            $colores->save();
            return response()->json([
                'mensaje' => 'Se ha guardado el color ' . $colores->color . ' en la base de datos',
                'data' => $colores
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ha ocurrido un error al agregar el color en la base de datos',
                'mensaje' => $colores->getMessage()
            ],500);
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
        $colores=Colores::findOrFail($id);
        try {
            return response()->json([
                'mensaje' => 'Se consulto el color ' . $colores->color . ' de la base de datos',
                'data' => $colores
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se obtuvo el color solicitado',
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
        $reglas=[
            'color' => 'required|string|max:200',
        ];
        $validador=Validator::make($request->all(),$reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ],422);
        }
        try {
            $colores=Colores::findOrFail($id);
            $colores->color=$request->color;
            $colores->save();
            return response()->json([
                'mensaje' => 'Se ha actualizado el color ' . $colores->color . ' en la base de datos',
                'data' => $colores
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se actualizo el color solicitado',
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
        try {
            $colores=Colores::findOrFail($id);
            $colores->delete();
            return response()->json([
                'mensaje' => 'Se ha eliminado el color ' . $colores->color . ' de la base de datos',
                'data' => $colores
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se elimino el color deseado',
                'mensaje' => $e->getMessage()
            ],500);
        }
    }
}
