<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'item_desc',
        'function_type_id',
        'item_price',
    ];
    public function function_type()
    {
        return $this->belongsTo(FunctionType::class);
    }
}
