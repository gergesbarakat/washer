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
        'user_id',
        'courier_id',
        'from_branch_id',
        'to_branch_id',
        'sender_name',
        'sender_address',
        'sender_contact',
        'recipient_name',
        'recipient_address',
        'recipient_contact',
        'type'
    ];

    public function items()
    {
        return $this->hasMany(ParcelItem::class);
    }

    public function hotel()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function fromBranch()
    {
        return $this->belongsTo(Branch::class, 'from_branch_id');
    }

    public function toBranch()
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }
}
