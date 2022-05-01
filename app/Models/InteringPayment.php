<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteringPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'intering_payment',
    ];
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}