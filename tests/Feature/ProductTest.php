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
}
