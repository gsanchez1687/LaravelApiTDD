<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function admin()
    {
        try {
            $products = ProductModel::with('category')->get();
            return response()->json($products, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al listar los productos'], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = ProductModel::with('category')->find($id);
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al obtener el producto'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = ProductModel::find($id);
            $product->update($request->all());
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al actualizar el producto'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = ProductModel::find($id);
            $product->delete();
            return response()->json(['message' => 'Producto eliminado'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al eliminar el producto'], 500);
        }
    }
}
