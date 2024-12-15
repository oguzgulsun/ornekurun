<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'sku', 
        'regular_price', 
        'discount_price', 
        'quantity', 
        'short_description', 
        'product_weight', 
        'product_note', 
        'published', 
        'category_id',
        'created_by',
        'updated_by'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class); // Product, Category'ye aittir
    }

}
