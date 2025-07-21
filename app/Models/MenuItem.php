<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'menu_item_restaurant', 'menu_item_id', 'restaurant_id');
    }
}
