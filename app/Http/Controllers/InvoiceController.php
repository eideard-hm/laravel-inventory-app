<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function show()
    {
        $invoices = Invoice::all();
        return view('invoice.list', compact('invoices'));
    }

    function form()
    {
        $products = Product::all();
        return view('invoice.form', compact('products'));
    }

    function save(Request $request)
    {
        $id = intval($request->input('idBrand'));

        $request->validate([
            'nombre' => ['required', 'max:50']
        ]);

        $brand = new Invoice();

        // Validar si viene algo en el idProduct quiere decir que vamos a editar
        // de los contrario es para insertar

        if ($id > 0) {
            $brand = Invoice::findOrFail($id);
        }

        $brand->name = $request->input('nombre');

        $brand->save();
        return redirect()
            ->route('brand.getAll')
            ->with('message', 'Marca guardada exitosamente!!');
    }
}
