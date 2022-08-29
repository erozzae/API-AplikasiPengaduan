<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'level' => 'admin',
                'name' => 'admin ',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]
        ]);
    }
}
