<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nome' => 'Raphael',
            'email' => 'raphaelaugustoadm@gmail.com',
            'password' => bcrypt('12345'),
            'tema' => 1,
        ]);
    }
}
