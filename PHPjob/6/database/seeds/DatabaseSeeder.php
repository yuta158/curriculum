<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Gig',
            'email' => 'b@hotmail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Taro',
            'email' => 't@hotmail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Jiro',
            'email' => 'j@hotmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
