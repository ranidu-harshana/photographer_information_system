<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_nulber',
        'name',
        'address',
        'mob_no1',
        'mob_no2',
        'wedding_date',
        'wedding_location',
        'home_com_date',
        'home_com_location',

        // 'event_type',

        'event_date',
        'event_location',
        'photo_shoot_date',
        'photo_shoot_location',
        'total_payment',
        'discount',
        'advance_payment',
    ];

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
