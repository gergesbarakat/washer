<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'description', 'price', 'stock'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function parcels()
    {
        return $this->belongsToMany(Parcel::class, 'parcel_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
