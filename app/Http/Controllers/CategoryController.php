<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function getAll()
    {
        $categories = Category::all();
        return view('categories.showCategories', compact('categories'));
    }

    //Método para cargar la información de la categoria y poder
    // diferenciar si se quera actualizar o editar
    //Método para añadir productos
    function add(int $id = null)
    {
        if (!empty($id)) {
            $category = Category::findOrFail($id);
        } else {
            $category = new Category();
        }
        return view('categories.addCategory', compact('category'));
    }

    function save(Request $request)
    {
        $idCategoria = intval($request->input('idCategory'));

        $request->validate([
            'nombre' => ['string', 'required', 'max:50'],
            'description' => ['required', 'max:1000']
        ]);

        $category = new Category();

        if ($idCategoria > 0) {
            $category = Category::findOrFail($idCategoria);
        }

        $category->name = $request->input('nombre');
        $category->description = $request->input('description');

        $category->save();
        return redirect()
            ->route('category.getAll')
            ->with('message', 'Categoria guardada exitosamente!!');
    }

    function delete(int $id)
    {
        Category::destroy($id);
        return redirect()->route('category.getAll');
    }
}
