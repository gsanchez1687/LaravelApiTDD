<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    public function admin()
    {
        try {
            $categories = CategoryModel::all();
            return response()->json($categories, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al listar las categorias'], 500);
        }
    }

    public function show($id)
    {
        try {
            $category = CategoryModel::find($id);
            return response()->json($category, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al obtener la categoria'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $category = CategoryModel::create($request->all());
            return response()->json($category, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al crear la categoria'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $category = CategoryModel::find($id);
            $category->update($request->all());
            return response()->json($category, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al actualizar la categoria'], 500);
        }
    }


}
