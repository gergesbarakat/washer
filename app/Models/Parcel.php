<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Courier;
use App\Models\ParcelItem;


class Parcel extends Model
{
    /** @use HasFactory<\Database\Factories\ParcelFactory> */
    use HasFactory;
    protected $fillable = [
        'id',
        'hotel_id',
        'courier_id',
        'branch_id',
        'to_branch_id',
        'sender_name',
        'sender_address',
        'sender_contact',
        'recipient_name',
        'recipient_address',
        'recipient_contact',
        'type',
        'product_ids',
        'product_quantities',
        'status',

    ];

    public function hotel()
    {
        return $this->belongsTo(User::class, 'hotel_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'parcel_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function items()
    {
        return $this->hasMany(ParcelItem::class);
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


    public function toBranch()
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }
}
