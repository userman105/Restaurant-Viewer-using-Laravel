<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'Customers';
    protected $primaryKey = 'CustomerID';
    public $timestamps = true;

    protected $fillable = [
        'CustomerFName',
        'CustomerLName',
        'PhoneNo',
        'Address',
        'Email',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
