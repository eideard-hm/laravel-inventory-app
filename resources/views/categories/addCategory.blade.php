@extends('layout')
@section('title', ' Inventory App | 2242742')
@section('encabezado', $category->id ? 'Actualizar categoria' : 'Agregar categoria')
@section('content')
    <form class="row g-3 col-md-8" id="form-add_Product" action="{{ route('category.save') }}" method="POST">
        @csrf

        <div>
            {{ $category }}
        </div>

        <input type="hidden" name="idCategory" id="idCategory" value="{{ $category->id ? $category->id : 0 }}">

        <div class="col-md-12">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" placeholder="Equipos tecnologicos" id="nombre" name="nombre"
                value="{{ $category->name ? $category->name : old('name') }}">
        </div>
        <div class="col-md-12">
            @error('nombre')
                <div class="alert alert-danger" role="alert">
                    Se debe de introducir un nombre {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-12">
            <label for="description" class="form-label">Descripcion</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">
            {{ $category->description ? $category->description : old('description') }}
            </textarea>
        </div>
        <div class="col-md-12">
            @error('nombre')
                <div class="alert alert-danger" role="alert">
                    Se debe de introducir una descripción {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-12">
            <a href="{{ route('category.getAll') }}" class="btn btn-info">Ver lista categorias 👉</a>
            <button type="submit" class="btn btn-primary">{{ $category->id ? 'Actualizar ✏' : 'Agregar ✅' }}</button>
        </div>
    </form>
@endsection
