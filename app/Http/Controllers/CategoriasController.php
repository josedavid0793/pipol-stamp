<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias=Categorias::all();
        return response()->json([$categorias,200]);
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
            'nombre'=>'required|string|max:200',
            'descripcion'=>'nullable|string|max:500'
        ];
        $validador=Validator::make($request->all(),$reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ],422);
        }

        try {
            $categorias=new Categorias();
            $categorias->nombre = $request->nombre;
            $categorias->descripcion=$request->descripcion;
            $categorias->save();
            return response()->json([
                'mensaje' => 'Se ha guardado la categoria ' . $categorias->nombre . ' en la base de datos',
                'data' => $categorias
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            response()->json([
                'error' => 'Ha ocurrido un error al agregar el color en la base de datos',
                'mensaje' => $categorias->getMessage()
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
        $categorias=Categorias::findOrFail($id);
        try {
            return response()->json([
                'mensaje' => 'Se consulto la categoría ' . $categorias->nombre . ' de la base de datos',
                'data' => $categorias
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se obtuvo la categoría solicitada',
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
            'nombre'=>'required|string|max:200',
            'descripcion'=>'nullable|string|max:500'
        ];
        $validador=Validator::make($request->all(),$reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ],422);
        }
        try {
            $categorias=Categorias::findOrFail($id);
            $categorias->nombre=$request->nombre;
            $categorias->descripcion=$request->descripcion;
            $categorias->save();
            return response()->json([
                'mensaje' => 'Se ha actualizado la categoría ' . $categorias->nombre . ' en la base de datos',
                'data' => $categorias
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se actualizo la categoría solicitada',
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
            $categorias=Categorias::findOrFail($id);
            $categorias->delete();
            return response()->json([
                'mensaje' => 'Se ha eliminado la categoría ' . $categorias->nombre . ' de la base de datos',
                'data' => $categorias
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se elimino la categoría deseada',
                'mensaje' => $e->getMessage()
            ],500);
        }
    }
}
