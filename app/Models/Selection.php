<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Selection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'package_id',
        'date_for',
        'status',
        'tips'
    ];

    protected $appends = [
        'package_name',
        'package_description',
        'tips_count',
    ];

    /**
     * @throws \JsonException
     */
    public function getTipsCountAttribute(): int
    {
        if ($this->tips) {
            return count(json_decode($this->attributes['tips'], false, 512, JSON_THROW_ON_ERROR));
        } else {
            return 0;
        }
    }

    public function getPackageNameAttribute()
    {

        $package = Packages::find($this->attributes['package_id']);

        if ($package) {
            return $package->name;
        } else {
            return 'N/A';
        }
    }

    public function getPackageDescriptionAttribute()
    {

        $package = Packages::find($this->attributes['package_id']);

        if ($package) {
            return $package->description;
        } else {
            return 'N/A';
        }
    }
}
