<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
