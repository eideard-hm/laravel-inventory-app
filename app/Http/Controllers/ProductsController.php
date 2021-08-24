<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // function getOne(int $id)
    // {
    //     $getProduct = Product::find($id);
    //     return view('products/product', ['oneProducts' => $getProduct->toArray()]);
    // }

    //Método para añadir productos
    function addProduct(int $id = null)
    {
        if (!empty($id)) {
            $product = Product::findOrFail($id);
        } else {
            $product = new Product();
        }
        $brands = Brand::all();
        $categories = Category::all();
        return view('/products/addProduct', compact('product', 'brands', 'categories'));
    }

    function save(Request $request)
    {
        $id = intval($request->input('idProduct'));

        $request->validate([
            'nombre' => ['required', 'max:50'],
            'costo' => ['required', 'numeric'],
            'precio' => ['required', 'numeric'],
            'cantidad' => ['required', 'numeric'],
            'marca' => ['required', 'max:50'],
            'marca' => ['required', 'max:50'],
        ]);

        $product = new Product;

        // Validar si viene algo en el idProduct quiere decir que vamos a editar
        // de los contrario es para insertar

        if ($id > 0) {
            $product = Product::findOrFail($id);
        }

        $product->name = $request->input('nombre');
        $product->cost = $request->input('costo');
        $product->price = $request->input('precio');
        $product->quantity = $request->input('cantidad');
        $product->brand_id = $request->input('marca');
        $product->category_id = $request->input('categoria');

        $product->save();
        return redirect()
            ->route('products.getAll')
            ->with('message', 'Producto guardado exitosamente!!');;
    }

    // Método para traer todos los registros
    function getAll()
    {
        $products = Product::all();
        return view('products/product', ['products' => $products]);
    }

    // Método para eliminar
    function delete(int $id)
    {
        // $product = Product::find($id);
        // $product->delete();
        $product = Product::destroy($id);
        return redirect()->route('products.getAll');
    }
}
