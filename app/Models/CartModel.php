<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    //agregar relaciones con los modelos
    public function product(){
        return $this->belongsTo(ProductModel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
