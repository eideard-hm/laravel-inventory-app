@extends('layout')
@section('title', 'Agregar factura')
@section('encabezado', 'Nueva factura')
@section('content')
    <form class="row g-3 col-md-12" id="form-add_Product" action="{{ route('invoice.save') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-sm-3"><b>Producto</b></div>
            <div class="col-sm-3"><b>Cantidad</b></div>
            <div class="col-sm-3"><b>Precio</b></div>
            <div class="col-sm-2"><b>Total productos</b></div>
            <div class="col-sm-1"><b>Acciones</b></div>
        </div>

        <input type="hidden" name="idInvoice" id="idInvoice" value="">

        <div class="row form-group">
            <div class="col-sm-3">
                <select class="form-select" name="product[]" id="products">
                    <option value="" disabled selected>-- Seleccione un producto --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-name="{{ $product->name }}">{{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3">
                <input type="number" class="form-control quantity" placeholder="Cantidad" id="quantity" name="quantity[]"
                    min="1" value="1">
            </div>

            <div class="col-sm-3">
                <input type="number" class="form-control price" placeholder="Precio" id="price" name="price[]">
            </div>

            <div class="col-sm-2">
                <input type="number" readonly class="form-control-plaintext totalProduct" placeholder="Total"
                    id="totalProduct" name="totalProduct">
            </div>

            <div class="col-sm-1 text-center">
                <a class="btn btn-success" id="add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path
                            d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z" />
                    </svg>
                </a>
            </div>
        </div>
    </form>

    <div class="row mt-5">
        <div class="col-12">
            <h4 class="text-center text-danger">Detalles de factura</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="products-invoice">
                </tbody>
                <tfoot id="product-invoice-footer">
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const products = @json($products);
    </script>
    <script src="{{ asset('js/products.js') }}" type="module" defer></script>
@endsection
