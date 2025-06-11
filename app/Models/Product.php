<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    //Defines the Product model and relationships with other models
    protected $fillable = ['name'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
    //Relationship with the Variant model
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

}
