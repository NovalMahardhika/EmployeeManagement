<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          
            "id_role" =>1,
            "username"=> "Babam",
            "last_name"=> "Shanum",
            "first_name"=> "Fahiya",
            "email"=> "admin@admin.com", 
            "password"=> bcrypt(12345678)
        ],
 );

        User::create([ 
        
            "username"=> "Babam",
            "last_name"=> "Shanum",
            "first_name"=> "Fahiya",
            "email"=> "employee@employee.com", 
            "password"=>bcrypt(12345678) ]);

    }
}

