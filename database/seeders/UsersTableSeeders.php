<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        User::create([
            'name'=> 'Cesar Sanchez',
            'email'=> 'cesars.pro@gmail.com',
            'password'=> bcrypt('cesar001'),
            'dni'=> 29850521,
            'role'=> 'admin'
        ]);

        User::create([
            'name'=> 'Fabiana Carina Iozia',
            'email'=> 'cardiosancris@gmail.com',
            'password'=> bcrypt('fabiana001'),
            'dni'=> 29850521,
            'role'=> 'doctor'
        ]);

        User::create([
            'name'=> 'Claudio R Sanchez',
            'email'=> 'sanchezproductor@gmail.com',
            'password'=> bcrypt('claudio001'), 
            'dni'=> 29850521,
            'role'=> 'patien'
        ]);
        User::factory()->count(50)->create(); 
    }
}
