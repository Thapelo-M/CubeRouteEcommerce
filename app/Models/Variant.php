<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Variant extends Model
{
    use HasFactory;

    // Defines the Variant model and relationships with other Product models
    protected $fillable = ['product_id', 'name', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
