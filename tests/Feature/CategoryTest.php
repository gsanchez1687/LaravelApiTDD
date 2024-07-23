<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\CategoryModel;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_categories_can_be_retrived(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/categories/all');

        $response->assertStatus(200);

        $this->assertIsArray($response->json());
    }

    public function test_category_can_be_retrived(): void
    {
        $this->withoutExceptionHandling();
        //creamos una categoria
        $category = CategoryModel::create([
            'name' => 'Categoria de prueba-'.time(),
            'slug' => 'categoria-de-prueba-'.time(),
            'description' => 'Descripcion de la categoria de prueba'
        ]);

        $response = $this->get('/api/category/id/'.$category->id);

        //lo que esperamos
        $response->assertStatus(200);
        $this->assertEquals('Categoria de prueba-'.time(), $response->json()['name']);
        $this->assertEquals('categoria-de-prueba-'.time(), $response->json()['slug']);
        $this->assertEquals('Descripcion de la categoria de prueba', $response->json()['description']);
        $this->assertIsArray($response->json());
    }

    public function test_category_can_be_created(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/category/create', [
            'name' => 'Categoria de prueba-'.time(),
            'slug' => 'categoria-de-prueba-'.time(),
            'description' => 'Descripcion de la categoria de prueba'
        ]);

        $response->assertStatus(200);
        $this->assertEquals('Categoria de prueba-'.time(), $response->json()['name']);
        $this->assertEquals('categoria-de-prueba-'.time(), $response->json()['slug']);
        $this->assertEquals('Descripcion de la categoria de prueba', $response->json()['description']);
        $this->assertIsArray($response->json());
    }
}
