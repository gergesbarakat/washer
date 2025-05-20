<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'category_id', 'name', 'description', 'price', 'stock',        'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
