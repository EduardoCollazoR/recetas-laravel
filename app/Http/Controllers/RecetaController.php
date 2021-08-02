<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Auth::user()->recetas->dd(); */


        /* $recetas = auth()->user()->recetas; */
        $usuario = auth()->user()->id;

        //recetas con paginacion 
        $recetas = Receta::where('user_id', $usuario)->paginate(5);

        return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd(); */

        /* obtener las categorias sin modelo */
        /* $categorias = DB::table('categoria_recetas')
            ->get()
            ->pluck('nombre', 'id'); */

        /* obtener las categorias con modelo */

        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion de entradas
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);
        //obtener la ruta de imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //resize de la imagen 
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        //almacenar en base de datos sin modelos
        /*  DB::table('recetas')->insert([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()->id,
            'categoria_id' => $data['categoria']

        ]); */
        /*   dd($request->all()); */

        //almacenar en la base de datos con modelo 
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria']
        ]);

        return redirect()->action([RecetaController::class, "index"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //revisar el policy
        $this->authorize('view', $receta);
        //con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        //revisar el policy 
        $this->authorize('update', $receta);
        //validacion
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);

        //asignar los valores 
        $receta->titulo = $data['titulo'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];
        $receta->categoria_id = $data['categoria'];

        //si el usuario sube una nueva imagen
        if (request('imagen')) {
            //obtener la ruta de imagen
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            //resize de la imagen 
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            //asignar al objeto imagen
            $receta->imagen = $ruta_imagen;
        }

        $receta->save();
        //redireccionar
        return redirect()->action([RecetaController::class, "index"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete', $receta);
        //eliminar receta
        $receta->delete();
        return redirect()->action([RecetaController::class, "index"]);
    }
}
