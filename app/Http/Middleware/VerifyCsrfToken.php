<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'productos/*',  // Excluir todas las rutas que coincidan con productos/*
        'productos',  // Excluir todas las rutas que coincidan con productos/*

        'descuentos/*',  // Excluir todas las rutas que coincidan con descuentos/*
        'descuentos',  // Excluir todas las rutas que coincidan con descuentos/*

        'tallas/*',  // Excluir todas las rutas que coincidan con tallas/*
        'tallas',  // Excluir todas las rutas que coincidan con tallas/*

        'estilos/*',  // Excluir todas las rutas que coincidan con estilos/*
        'estilos',  // Excluir todas las rutas que coincidan con estilos/*

        'marcas/*',  // Excluir todas las rutas que coincidan con marcas/*
        'marcas',  // Excluir todas las rutas que coincidan con marcas/*
        
        'colores/*',  // Excluir todas las rutas que coincidan con colores/*
        'colores',  // Excluir todas las rutas que coincidan con colores/*

        'generos/*',  // Excluir todas las rutas que coincidan con generos/*
        'generos',  // Excluir todas las rutas que coincidan con generos/*

        'categorias/*',  // Excluir todas las rutas que coincidan con categorias/*
        'categorias',  // Excluir todas las rutas que coincidan con categorias/*
    ];
}
