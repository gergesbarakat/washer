<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /** @use HasFactory<\Database\Factories\BranchFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'street',
        'city',
        'state',
        'zip_code',
        'country',
        'contact'
    ];

    public function couriers()
    {
        return $this->hasMany(Courier::class);
    }
}
