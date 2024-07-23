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

    public function update(Request $request, $id){
        try {
            $cart = CartModel::find($id);
            $cart->update($request->all());
            return response()->json($cart, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al actualizar el producto del carrito'], 500);
        }
    }

    public function destroy($id){
        try {
            $cart = CartModel::where('product_id',$id)->first();
            $cart->delete();
            return response()->json(['message' => 'Producto eliminado del carrito'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al eliminar el producto del carrito'], 500);
        }
    }

    public function show($id){
        try {
            
            $cart = CartModel::find($id);
            return response()->json($cart, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al mostrar los productos del carrito'], 500);
        }
    }
}
