<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'cuisine_type',
        'address',
        'city',
        'state',
        'postal_code',
        'phone',
        'email',
        'website',
        'opening_hours',
        'rating',
        'price_range',
        'featured',
        'image',
        'latitude',
        'longitude',
        'delivery_available',
        'takeout_available',
        'reservation_available',
        'employee_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'float',
        'price_range' => 'integer',
        'featured' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
        'delivery_available' => 'boolean',
        'takeout_available' => 'boolean',
        'reservation_available' => 'boolean',
    ];


    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_restaurant', 'restaurant_id', 'menu_item_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function orders()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_restaurant');
    }

    public function getPriceRangeFormattedAttribute()
    {
        return str_repeat('$', $this->price_range);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeWithDelivery($query)
    {
        return $query->where('delivery_available', true);
    }

    public function scopeWithTakeout($query)
    {
        return $query->where('takeout_available', true);
    }

    public function scopeWithReservation($query)
    {
        return $query->where('reservation_available', true);
    }

    public function scopeByCuisine($query, $cuisineType)
    {
        return $query->where('cuisine_type', $cuisineType);
    }

    public function scopeByMinRating($query, $rating)
    {
        return $query->where('rating', '>=', $rating);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'EmployeeID');

    }

    public function employees()
    {
        return $this->belongsToMany(User::class, 'restaurant_employee', 'restaurant_id', 'user_id');
    }
}
