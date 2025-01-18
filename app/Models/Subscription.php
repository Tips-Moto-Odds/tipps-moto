<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['*'];

    protected $appends = [
        'package_name'
    ];

    public function getPackageNameAttribute()
    {
        return Packages::find($this->attributes['package_id'])->name;
    }

    public function package(){
        return $this->belongsTo(Packages::class);
    }

}
