<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'sku',
        'slug',
        'description',
        'category_id',
        'price',
        'stock',
        'updated_at',
        'created_at'
    ];

    //agregar relaciones
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id');
    }

    public function cart()
    {
        return $this->hasMany(CartModel::class);
    }
}
