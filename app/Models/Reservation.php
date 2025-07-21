<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'user_id',
        'date',
        'time',
        'guests',
        'special_requests',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'CustomerID');
    }


}
