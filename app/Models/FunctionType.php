<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionType extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
