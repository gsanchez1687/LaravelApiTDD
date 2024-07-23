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
}
