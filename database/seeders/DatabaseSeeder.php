<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'fname' => 'admin',
            'lname' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 4,
            'cpf' => '59323342238',
            'phone' => '(51) 98659-3952',
            'password' => Hash::make('admin@123')
        ]);

        \App\Models\User::factory()->create([
            'fname' => 'Lucas',
            'lname' => 'Cezar',
            'email' => 'czartrentin@gmail.com',
            'role' => 1,
            'cpf' => '83220775489',
            'phone' => '(51) 98659-3952',
            'password' => Hash::make('admin@123')
        ]);

        \App\Models\User::factory()->create([
            'fname' => 'Manoel',
            'lname' => 'Gomes',
            'email' => 'manoelgomes@gmail.com',
            'role' => 1,
            'cpf' => '50657574295',
            'phone' => '(51) 98659-3952',
            'password' => Hash::make('admin@123')
        ]);

        \App\Models\User::factory()->create([
            'fname' => 'Rogério',
            'lname' => 'Skylab',
            'email' => 'cigarro@gmail.com',
            'role' => 1,
            'cpf' => '20206856636',
            'phone' => '(51) 98659-3952',
            'password' => Hash::make('admin@123')
        ]);


        // run on terminal: php artisan db:seed --force
    }
}
