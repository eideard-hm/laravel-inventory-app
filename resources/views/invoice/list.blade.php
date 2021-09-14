@extends('layout')
@section('title', 'Detalle de factura')
@section('encabezado', 'Detalles de factura')
@section('content')
    <div class="text-center">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->created_at }}</td>
                        <td>$ {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
                        <td>$ {{ number_format($invoice->total, 0, ',', '.') }}</td>
                        <td>
                            <button type="button" class="btn btn-success" <button type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#modal{{ $invoice->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="modal{{ $invoice->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Invoice # {{ $invoice->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row border border-success">
                                        <div class="col-sm-3 border-end border-bottom"><strong>Producto</strong></div>
                                        <div class="col-sm-3 border-end border-bottom"><strong>Cantidad</strong></div>
                                        <div class="col-sm-3 border-end border-bottom"><strong>Precio</strong></div>
                                        <div class="col-sm-3 border-end border-bottom"><strong>Total Producto</strong></div>
                                    </div>
                                    @foreach ($invoice->product as $product)
                                        <div class="row">
                                            <div class="col-sm-3 border-end border-bottom">{{ $product->name }}</div>
                                            <div class="col-sm-3 border-end border-bottom">{{ $product->pivot->quantity }}
                                            </div>
                                            <div class="col-sm-3 border-end border-bottom">{{ $product->pivot->price }}
                                            </div>
                                            <div class="col-sm-3 border-end border-bottom">
                                                {{ $product->pivot->quantity * $product->pivot->price }}</div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-3"><strong>Subtotal:</strong></div>
                                        <div class="col-sm-3"><strong>{{ $invoice->subtotal }}</strong></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-3"><strong>Total:</strong></div>
                                        <div class="col-sm-3"><strong>{{ $invoice->total }}</strong></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
