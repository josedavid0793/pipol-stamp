<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100)->unique();
            $table->string('descripcion',500);
            $table->string('imagen',100)->unique();
            $table->decimal('precio',8, 2);
            $table->integer('total');
            // Definir las columnas de claves foráneas
            $table->decimal('descuento', 8,2);
            $table->string('categoria', 200);
            $table->string('marca', 200);
            $table->string('tallas', 200);
            $table->string('estilo', 200);
            $table->string('color', 200);
            $table->string('genero', 200);

            $table->foreign('descuento')->references('porcentaje')->on('descuentos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('categoria')->references('nombre')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('marca')->references('nombre')->on('marcas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tallas')->references('talla')->on('tallas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estilo')->references('nombre')->on('estilos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('color')->references('color')->on('colores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('genero')->references('genero')->on('generos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
