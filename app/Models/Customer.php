<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function packages() {
        return $this->belongsToMany(Package::class);
    }

    public function items() {
        return $this->belongsToMany(Item::class);
    }

    public function function_type() {
        return $this->belongsTo(FunctionType::class);
    }
}
