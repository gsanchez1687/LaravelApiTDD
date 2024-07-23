<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\CategoryModel;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_cart_can_be_create(): void
    {

        //crear una categoria para pasarle el id al producto
        $category = CategoryModel::create([
            'name' => 'Categoria de prueba-'.time(),
            'slug' => 'categoria-de-prueba-'.time(),
            'description' => 'Descripcion de la categoria de prueba'
        ]);

        //crear producto para agregar al carrito
        $product = ProductModel::create([
            'name' => 'Producto de prueba-'.time(),
            'sku' => 'sku-'.time(),
            'slug' => 'producto-de-prueba-'.time(),
            'description' => 'Descripcion del producto de prueba',
            'category_id' => $category->id,
            'price' => 1000,
            'stock' => 10
        ]);

        //enviar la petición para agregar al carrito
        $response = $this->post('/api/cart/add',[
            'user_id' => 1,
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $cart = CartModel::latest()->first();
        //dd($cart->product_id,$product->id);

        $this->assertCount($cart->id,CartModel::all());
        $this->assertEquals($cart->product_id,$product->id);

        $response->assertStatus(200);
        //$this->assertArrayHasKey('message',$response->json());
    }
}
