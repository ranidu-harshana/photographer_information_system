<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionType extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
