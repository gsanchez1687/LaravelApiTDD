<?php

namespace Tests\Feature;

use App\Models\ProductModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_product_can_be_list(): void
    {
        //crear un producto
        ProductModel::create([
            'name' => 'Producto de prueba-'.time(),
            'sku' => 'sku-'.time(),
            'slug' => 'producto-de-prueba-'.time(),
            'description' => 'Descripcion del producto de prueba',
            'category_id' => 1,
            'price' => 1000,
            'stock' => 10
        ]);

        $response = $this->get('/api/products/all');

        $response->assertStatus(200);

    }

    public function test_product_can_be_one_product_by_id(){
        //crear un producto
        $product = ProductModel::create([
            'name' => 'Producto de prueba-'.time(),
            'sku' => 'sku-'.time(),
            'slug' => 'producto-de-prueba-'.time(),
            'description' => 'Descripcion del producto de prueba',
            'category_id' => 1,
            'price' => 1000,
            'stock' => 10
        ]);

        $response = $this->get('/api/products/id/'.$product->id);

        $response->assertStatus(200);
        $this->assertArrayHasKey('name',$response->json());
    }

    public function test_product_can_be_update(){
        //crear un producto
        $product = ProductModel::create([
            'name' => 'Producto de prueba-'.time(),
            'sku' => 'sku-'.time(),
            'slug' => 'producto-de-prueba-'.time(),
            'description' => 'Descripcion del producto de prueba',
            'category_id' => 1,
            'price' => 1000,
            'stock' => 10
        ]);

        $response = $this->put('/api/products/update/id/'.$product->id,[
            'name' => 'Producto de prueba-actualizada'.time(),
            'sku' => 'sku-'.time(),
            'slug' => 'producto-de-prueba-actualizada'.time(),
            'description' => 'Descripcion del producto de prueba actualizada',
            'category_id' => 1,
            'price' => 1000,
            'stock' => 10
        ]);

        $response->assertStatus(200);
    }

    public function test_product_can_be_delete(){
        //crear un producto
        $product = ProductModel::create([
            'name' => 'Producto de prueba-'.time(),
            'sku' => 'sku-'.time(),
            'slug' => 'producto-de-prueba-'.time(),
            'description' => 'Descripcion del producto de prueba',
            'category_id' => 1,
            'price' => 1000,
            'stock' => 10
        ]);

        $response = $this->delete('/api/products/delete/id/'.$product->id);

        $response->assertStatus(200);
    }

}
