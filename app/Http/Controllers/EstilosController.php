<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Estilos;

use Illuminate\Http\Request;

class EstilosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estilos = Estilos::all();
        return response()->json([$estilos, 200]);
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
            'nombre' => 'required|string|max:100',
            'descripcion' => 'string|max:500',
        ];

        $validador = Validator::make($request->all(), $reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ], 422);
        }
        try {
            $estilos = new Estilos();
            $estilos->nombre = $request->nombre;
            $estilos->descripcion = $request->descripcion;
            $estilos->save();

            return response()->json([
                'mensaje' => 'Se ha guardado el estilo ' . $estilos->nombre . ' en la base de datos',
                'data' => $estilos
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ha ocurrido un error al agregar el estilo en la base de datos',
                'mensaje' => $estilos->getMessage()
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
        $estilos = Estilos::findOrFail($id);

        try {
            return response()->json([
                'mensaje' => 'Se consulto el estilo ' . $estilos->nombre . ' de la base de datos',
                'data' => $estilos
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se obtuvo el estilo solicitado',
                'mensaje' => $e->getMessage()
            ], 500);
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
            'nombre' => 'required|string|max:100',
            'descripcion' => 'string|max:500',
        ];
        $validador = Validator::make($request->all(), $reglas);

        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ], 422);
        }

        try {
            $estilos=Estilos::findOrFail($id);
            $estilos->nombre = $request->nombre;
            $estilos->descripcion = $request->descripcion;
            $estilos->save();

            return response()->json([
                'mensaje' => 'Se ha actualizado el estilo ' . $estilos->nombre . ' en la base de datos',
                'data' => $estilos
            ],200,[],JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            response()->json([
                'error' => 'No se actualizo el estilo solicitado',
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
            $estilos=Estilos::findOrFail($id);
            $estilos->delete();
            return response()->json([
                'mensaje' => 'Se ha eliminado el estilo ' . $estilos->nombre . ' de la base de datos',
                'data' => $estilos
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
           response()->json([
            'error' => 'No se elimino el estilo deseado',
            'mensaje' => $e->getMessage()
           ],500);
        }
    }
}
