<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Generos;
use Illuminate\Http\Request;

class GenerosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos=Generos::all();
        return response()->json([$generos,200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas=[
            'genero'=>'required|string|max:200'
        ];
        $validador=Validator::make($request->all(),$reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ],422);
        }

        try {
            $generos=new Generos();
            $generos->genero=$request->genero;
            $generos->save();
            return response()->json([
                'mensaje' => 'Se ha guardado el genero ' . $generos->genero . ' en la base de datos',
                'data' => $generos
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ha ocurrido un error al agregar el genero en la base de datos',
                'mensaje' => $generos->getMessage()
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
        $generos=Generos::findOrFail($id);
        try {
            return response()->json([
                'mensaje' => 'Se consulto el genero ' . $generos->genero . ' de la base de datos',
                'data' => $generos
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
              'genero'=>'required|string|max:200'
        ];

        $validador=Validator::make($request->all(),$reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ],422);
        }
        try {
            $generos=Generos::findOrFail($id);
            $generos->genero = $request->genero;
            $generos->save();
            return response()->json([
                'mensaje' => 'Se ha actualizado el genero ' . $generos->genero . ' en la base de datos',
                'data' => $generos
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se actualizo el genero solicitado',
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
            $generos=Generos::findOrFail($id);
            $generos->delete();
            return response()->json([
                'mensaje' => 'Se ha eliminado el genero ' . $generos->genero . ' de la base de datos',
                'data' => $generos
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se elimino el genero deseado',
                'mensaje' => $e->getMessage()
            ],500);
        }
    }
}
