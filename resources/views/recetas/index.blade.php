@extends('layouts.app')

@section('content')
    @section('botones')
   <a href="{{route('recetas.create')}}" class="btn btn-primary mr-2"> Crear Receta</a>
    @endsection

<h2 class="text-center mb-S">Administra tu recetas</h2>
<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scole="col">Titulo</th>
                 <th scole="col">Categoria</th>
                  <th scole="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pizza</td>
                <td>Pizzas</td>
                <td>

                </td>
            </tr>
        </tbody>
    </table>
</div>

    

@endsection