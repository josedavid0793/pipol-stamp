<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Productos::all();
        return response()->json([$productos, 200]);
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
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|string|max:500',
            'precio' => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
            /*'precio' => 'required|decimal:1',*/
            'total' => 'required|integer',
            'descuento' => 'required|numeric|between:0,100',
            'categoria' => 'required|string|max:200',
            'marca' => 'required|string|max:200',
            'talla' => 'required|string|max:100',
            'estilo' => 'required|string|max:100',
            'color' => 'required|string|max:200',
            'genero' => 'required|string|max:200',
        ];
        $validador = Validator::make($request->all(), $reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ], 422);
        }
        try {
            $productos = new Productos();
            $productos->nombre = $request->nombre;
            $productos->descripcion = $request->descripcion;
            $productos->imagen = $request->imagen;

            // Ajustar el precio a 1 decimal si es necesario
            $precio = number_format($request->precio, 1, '.', ''); // Redondea a 1 decimal
            $productos->precio = $precio;

            /*$productos->precio=$request->precio;*/
            $productos->total = $request->total;
            $productos->descuento = $request->descuento;
            $productos->categoria = $request->categoria;
            $productos->marca = $request->marca;
            $productos->talla = $request->talla;
            $productos->estilo = $request->estilo;
            $productos->color = $request->color;
            $productos->genero = $request->genero;
            $productos->save();
            return response()->json([
                'mensaje' => 'Se ha guardado el producto ' . $productos->nombre . ' en la base de datos',
                'data' => $productos
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ha ocurrido un error al agregar el producto en la base de datos',
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
        $productos=Productos::findOrFail($id);
        try {
            return response()->json([
                'mensaje' => 'Se consulto el genero ' . $productos->nombre . ' de la base de datos',
                'data' => $productos
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
        $reglas = [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|string|max:500',
            'precio' => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
            /*'precio' => 'required|decimal:1',*/
            'total' => 'required|integer',
            'descuento' => 'required|numeric|between:0,100',
            'categoria' => 'required|string|max:200',
            'marca' => 'required|string|max:200',
            'talla' => 'required|string|max:100',
            'estilo' => 'required|string|max:100',
            'color' => 'required|string|max:200',
            'genero' => 'required|string|max:200',
        ];
        $validador = Validator::make($request->all(), $reglas);
        if ($validador->fails()) {
            return response()->json([
                'error' => 'Ha ocurrido un error al validar los datos enviados',
                'mensaje' => $validador->errors()
            ], 422);
        }
        try {
            $productos = Productos::findOrFail($id);
            $productos->nombre = $request->nombre;
            $productos->descripcion = $request->descripcion;
            $productos->imagen = $request->imagen;

            // Ajustar el precio a 1 decimal si es necesario
            $precio = number_format($request->precio, 1, '.', ''); // Redondea a 1 decimal
            $productos->precio = $precio;

            /*$productos->precio=$request->precio;*/
            $productos->total = $request->total;
            $productos->descuento = $request->descuento;
            $productos->categoria = $request->categoria;
            $productos->marca = $request->marca;
            $productos->talla = $request->talla;
            $productos->estilo = $request->estilo;
            $productos->color = $request->color;
            $productos->genero = $request->genero;
            $productos->save();
            return response()->json([
                'mensaje' => 'Se ha actualizado el producto ' . $productos->nombre . ' en la base de datos',
                'data' => $productos
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ha ocurrido un error al actualizar el producto en la base de datos',
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
            $productos = Productos::findOrFail($id);
            $productos->delete();
            return response()->json([
                'mensaje' => 'Se ha eliminado el producto ' . $productos->nombre . ' de la base de datos',
                'data' => $productos
            ],200,[],JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se elimino el producto deseado',
                'mensaje' => $e->getMessage()
            ],500);
        }
    }
}
