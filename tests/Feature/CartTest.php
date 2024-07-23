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
    }

    public function test_cart_can_be_update(){
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

        //enviar la petición para actualizar el carrito
        $response = $this->put('/api/cart/update/id/'.$cart->id,[
            'quantity' => 2
        ]);

        $cart = CartModel::latest()->first();

        $this->assertEquals($cart->product_id,$product->id);

        $response->assertStatus(200);
    }

    public function test_cart_product_can_be_delete(){
        //crear una categoria para pasarle el id al producto
        $category = CategoryModel::create([
            'name' => 'Categoria de prueba-'.time(),
            'slug' => 'categoria-de-prueba-'.time(),
            'description' => 'Descripcion de la categoria de prueba'
        ]);

        //crear producto para agregar al carrito
        for($i = 0; $i < 5; $i++){
            $product = ProductModel::create([
                'name' => 'Producto de prueba-'.time().$i,
                'sku' => 'sku-'.time().$i,
                'slug' => 'producto-de-prueba-'.time().$i,
                'description' => 'Descripcion del producto de prueba',
                'category_id' => $category->id,
                'price' => 1000,
                'stock' => 10
            ]);

             //enviar la petición para agregar al carrito
            $response = $this->post('/api/cart/add',[
            'user_id' => 1,
            'product_id' => $product->id,
            'quantity' => rand(1,5)
            ]);
        }

        $cart = CartModel::latest()->first();
        //enviar la petición para eliminar el carrito
        $response = $this->delete('/api/cart/delete/id/'.$product->id);

        $response->assertStatus(200);
    }

    public function test_cart_can_be_retrived(){
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
            $cart = $this->post('/api/cart/add',[
            'user_id' => 1,
            'product_id' => $product->id,
            'quantity' => 1
            ]);

            if($cart)
                $cart = CartModel::latest()->first();

        $response = $this->get('/api/cart/show/id/'.$cart->id);

        $response->assertStatus(200);
       
    }
}
