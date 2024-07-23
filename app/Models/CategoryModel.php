<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    //agregar relaciones
    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category_id', 'id');
    }
}
