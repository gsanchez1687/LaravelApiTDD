<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function admin()
    {
        try {
            $products = ProductModel::all();
            return response()->json($products, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al listar los productos'], 500);
        }
    }
}
