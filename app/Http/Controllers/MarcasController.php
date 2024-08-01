<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Marcas;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas=Marcas::all();
        return response()->json([$marcas,200]);

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
        ];

        $validador=Validator::make($request->all(),$reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ],422);
        }

        try {
            $marcas=new Marcas();
            $marcas->nombre=$request->nombre;
            $marcas->save();
            return response()->json([
                'mensaje' => 'Se ha guardado la marca ' . $marcas->nombre . ' en la base de datos',
                'data' => $marcas
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ha ocurrido un error al agregar la marca en la base de datos',
                'mensaje' => $marcas->getMessage()
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
        $marcas=Marcas::findOrFail($id);
        try {
            return response()->json([
                'mensaje' => 'Se consulto la marca ' . $marcas->nombre . ' de la base de datos',
                'data' => $marcas
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
             return response()->json([
                'error' => 'No se obtuvo la marca solicitada',
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
        $reglas =[
            'nombre'=>'required|string|max:200',
        ];

        $validador = Validator::make($request->all(),$reglas);

        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ],422);
        }

        try {
            $marcas=Marcas::findOrFail($id);
            $marcas->nombre =$request->nombre;
            $marcas->save();
            return response()->json([
                'mensaje' => 'Se ha actualizado la marca ' . $marcas->nombre . ' en la base de datos',
                'data' => $marcas
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
             return response()->json([
                'error' => 'No se actualizo la marca solicitada',
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
            $marcas=Marcas::findOrFail($id);
            $marcas->delete();
            return response()->json([
                'mensaje' => 'Se ha eliminado la marca ' . $marcas->nombre . ' de la base de datos',
                'data' => $marcas
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
            'error' => 'No se elimino la marca deseada',
            'mensaje' => $e->getMessage()
            ],500);
        }
    }
}
