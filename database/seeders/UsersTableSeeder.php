<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
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
            'first_name' => 'Kingshuk',
            'last_name' => 'Dhar',
            'email' => 'kingshuk@gmail.com',
            'password' =>md5('123456'),
            'role' =>'Admin',
            'status'=>true
        ]);
    }
}
