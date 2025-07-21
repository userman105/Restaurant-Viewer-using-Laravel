<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ACCOUNT_EMPLOYEE = 'employee';
    const ACCOUNT_CUSTOMER = 'customer';

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    public function getRedirectRoute()
    {

        if ($this->account_type === 'employee') {
            return route('employee.dashboard');
        }

        return route('customer.main');
    }
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_employee', 'user_id', 'restaurant_id');
    }

}
