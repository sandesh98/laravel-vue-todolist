<?php

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
        \App\User::create([
            'name' => 'Sandesh',
            'email' => 'sandeshb981@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
