<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fabiano Morais',
            'email' => 'fcpm_mike@hotmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}
