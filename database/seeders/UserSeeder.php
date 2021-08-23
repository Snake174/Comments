<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'proger',
            'email' => 'proger@mail.ru',
            'password' => 'proger'
        ]);

        DB::table('users')->insert([
            'name' => 'vovka',
            'email' => 'vovka@mail.ru',
            'password' => 'vovka'
        ]);
    }
}
