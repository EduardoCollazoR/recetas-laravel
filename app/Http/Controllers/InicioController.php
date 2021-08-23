<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;

class InicioController extends Controller
{
    //

    public function index()
    {

        //obtener las recetas mas nuevas
        $nuevas = Receta::latest()->take(5)->get();

        //obtenr todas las categorias

        $categorias = CategoriaReceta::all();

        //agrupar las recetas por categoria
        $recetas = [];

        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        return view('inicio.index', compact('nuevas', 'recetas'));
    }
}
