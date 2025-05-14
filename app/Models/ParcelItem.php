<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parcel;

class ParcelItem extends Model
{
    /** @use HasFactory<\Database\Factories\ParcelItemFactory> */
    use HasFactory;
    protected $fillable = ['product_id', 'parcel_id', 'quantity', 'weight', 'height', 'length', 'width', 'price',];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
