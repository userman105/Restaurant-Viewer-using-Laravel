<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
use HasFactory;


protected $table = 'employees';


protected $primaryKey = 'EmployeeID';


public $incrementing = false;


protected $keyType = 'string';


public $timestamps = false;

public function restaurants()
{
return $this->belongsToMany(Restaurant::class, 'employee_restaurant', 'employee_id', 'restaurant_id')
->withPivot('role', 'is_primary')
->withTimestamps();
}

protected $fillable = [
'EmployeeID',
    'user_id',
'EmployeeName',
'EmployeePosition',
'Phone',
];
}
