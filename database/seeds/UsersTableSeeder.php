<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('admin@gmail.com'),
        ]);
    }
}
