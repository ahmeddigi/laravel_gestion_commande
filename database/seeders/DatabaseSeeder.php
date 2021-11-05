<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;
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


        $roles = [
            ['code' => 'ADMIN', 'name' => 'Administrateur'],
            ['code' => 'CLIENT', 'name' => 'client'],
        ];
        DB::table('roles')->insert($roles);


        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'token' => "dsfdsfdfdds"
        ]);
    }
}
