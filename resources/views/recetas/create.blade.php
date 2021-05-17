@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" />
@endsection

@section('content')
    @section('botones')
   <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2">Volver</a>
    @endsection

<h2 class="text-center mb-S">Crear Nueva Receta</h2>
<div class="row justify-content-center mt-5">
   <div class="col-md-8">
       <form action="{{route('recetas.store')}}" method="POST" novalidate enctype="multipart/form-data">
        @csrf
           <div class="form-group">
               <label for="titulo">Titulo Receta</label>
               <input type="text" name="titulo" id="titulo" class="form-control @error('titulo')
                   is-invalid
               @enderror" placeholder="Titulo"
               value="{{old('titulo')}}"/>

               @error('titulo')
             <span class="invalid-feedback d-block" role="alert">
                 <strong>{{$message}}</strong>
             </span>
               @enderror
           </div>

           <div class="form-group">
               <label for="categoria"></label>
               <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">
                    <option value="">--Seleccione--</option>
                   @foreach($categorias as $id => $categoria)
                   <option value="{{$id}}" {{old('categoria') == $id ? 'selected' : ''}}>{{$categoria}}</option>
                    @endforeach
               </select>
               @error('categoria')
             <span class="invalid-feedback d-block" role="alert">
                 <strong>{{$message}}</strong>
             </span>
               @enderror
           </div>

           <div class="form-group mt-3">
               <label for="preparacion">Preparacion</label>
               <input type="hidden" id="preparacion"  name="preparacion" value="{{old('preparacion')}}">
               <trix-editor class="form-control @error('preparacion') is-invalid @enderror"
               input="preparacion"></trix-editor>
                @error('preparacion')
             <span class="invalid-feedback d-block" role="alert">
                 <strong>{{$message}}</strong>
             </span>
               @enderror
           </div>

           <div class="form-group mt-3">
               <label for="ingredientes">Ingredientes</label>
               <input type="hidden" id="ingredientes" name="ingredientes" value="{{old('ingredientes')}}">
               <trix-editor class="form-control @error('ingredientes') is-invalid @enderror"
               input="ingredientes"></trix-editor>
                @error('ingredientes')
             <span class="invalid-feedback d-block" role="alert">
                 <strong>{{$message}}</strong>
             </span>
               @enderror
           </div>

           <div class="form-group mt-3">
               <label for="imagen">Elige la imagen</label>
               <input type="file" 
               name="imagen" 
               id="imagen" 
               class="form-control @error('imagen') is-invalid @enderror">

                @error('imagen')
             <span class="invalid-feedback d-block" role="alert">
                 <strong>{{$message}}</strong>
             </span>
               @enderror
           </div>
<div class="form-group">
    <input type="submit" value="Agregar Receta" class="btn btn-primary">
</div>

       </form>
   </div>
</div>

    

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
@endsection