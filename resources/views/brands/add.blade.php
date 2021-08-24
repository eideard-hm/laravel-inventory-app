@extends('layout')
@section('title', 'Add products - Inventory App')
@section('encabezado', $brand->id ? 'Actualizar marca' : 'Agregar marca')
@section('content')
    <form class="row g-3 col-md-8" id="form-add_Product" action="{{ route('brand.Save') }}" method="POST">
        @csrf

        <input type="hidden" name="idBrand" id="idBrand" value="{{ $brand->id ? $brand->id : 0 }}">

        <div class="col-md-12">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" placeholder="Arroz" id="nombre" name="nombre"
                value="{{ $brand->name ? $brand->name : old('name') }}">
        </div>
        <div class="col-md-12">
            @error('nombre')
                <div class="alert alert-danger" role="alert">
                    Se debe de introducir un nombre {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-12">
            <a href="{{ route('brand.getAll') }}" class="btn btn-info">Ver lista marcas 👉</a>
            <button type="submit" class="btn btn-primary">{{ $brand->id ? 'Actualizar ✏' : 'Agregar ✅' }}</button>
        </div>
    </form>
@endsection
