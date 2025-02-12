<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Ensure correct model namespace

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "currency",
        "amount",
        "payment_method",
        "package_id",
        "transaction_type",
        "transaction_reference"
    ];

    // Define Accessor for packageBought
    public function getPackageBoughtAttribute()
    {
        return $this->package()->first();
    }

    // Define Relationship
    public function package()
    {
        return $this->belongsTo(Packages::class, 'package_id');
    }
}
