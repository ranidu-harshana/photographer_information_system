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
        'event_type',
        'event_date',
        'event_location',
        'photo_shoot_date',
        'photo_shoot_location',
        'preshoot_date',
        'preshoot_location',
        'total_payment',
        'discount',
        'discount_by',
        'branch_id',
        'advance_payment',
        'total_package_price',
        'total_item_price',
        'status',
        'posponed_date',
        'homecomming_posponed_date',
        'preshoot_postponed_date',

    ];

    public function packages() {
        return $this->belongsToMany(Package::class)->withPivot('id', 'package_price', 'status');
    }

    public function items() {
        return $this->belongsToMany(Item::class)->withPivot('id', 'item_price', 'quantity', 'status');
    }

    public function function_types() {
        return $this->belongsToMany(FunctionType::class)->withPivot('id', 'date', 'location', 'event_type', 'postponed_date', 'status');
    }

    public function notes()
    {
        return $this->hasMany(Note::class)->orderBy('created_at', 'DESC');
    }

    public function intering_payments() {
        return $this->hasMany(InteringPayment::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
}
