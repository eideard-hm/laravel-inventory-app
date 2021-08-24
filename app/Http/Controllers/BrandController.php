<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Método para añadir productos
    function add(int $id = null)
    {
        if (!empty($id)) {
            $brand = Brand::findOrFail($id);
        } else {
            $brand = new Brand();
        }
        return view('/brands/add', compact('brand'));
    }

    function save(Request $request)
    {
        $id = intval($request->input('idBrand'));

        $request->validate([
            'nombre' => ['required', 'max:50']
        ]);

        $brand = new Brand();

        // Validar si viene algo en el idProduct quiere decir que vamos a editar
        // de los contrario es para insertar

        if ($id > 0) {
            $brand = Brand::findOrFail($id);
        }

        $brand->name = $request->input('nombre');

        $brand->save();
        return redirect()
            ->route('brand.getAll')
            ->with('message', 'Marca guardada exitosamente!!');
    }

    // Método para traer todos los registros
    function getAll()
    {
        $brands = Brand::all();
        return view('brands/brand', ['brands' => $brands]);
    }

    // Método para eliminar
    function delete(int $id)
    {
        // $product = Product::find($id);
        // $product->delete();
        Brand::destroy($id);
        return redirect()->route('brand.getAll');
    }
}
