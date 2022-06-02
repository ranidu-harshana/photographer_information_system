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
        'package_id',
        'attach_func_type'
    ];

    public function function_types()
    {
        return $this->belongsToMany(FunctionType::class);
    }

    public function items() {
        return $this->belongsToMany(Item::class);
    }

    public function customers() {
        return $this->belongsToMany(Customer::class);
    }
}
