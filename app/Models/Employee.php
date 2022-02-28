<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'last_name',
        'first_name',
        'middle_name',
        'birthdate',
        'address',
        'department_id',
        'city_id',
        'country_id',
        'zip_code',
        'date_hired',
    
        
    ];

   
   public function department()
   {
       return $this->hasOne(Department::class, 'id', 'department_id');
   }

   public function city()
   {
       return $this->hasOne(City::class, 'id', 'city_id');
   }

   public function country()
   {
       return $this->hasOne(Country::class, 'id', 'country_id');
   }
  
   
}
