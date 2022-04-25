<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_code',
        'name',
        'desc',
        'package_price',
        'package_id'
    ];

    public function function_type()
    {
        return $this->belongsTo(FunctionType::class);
    }

    public function items() {
        return $this->belongsToMany(Item::class);
    }
}