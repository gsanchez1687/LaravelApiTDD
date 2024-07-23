<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        
        try {
            $cart = CartModel::create($request->all());
            return response()->json($cart, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al agregar el producto al carrito'], 500);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
