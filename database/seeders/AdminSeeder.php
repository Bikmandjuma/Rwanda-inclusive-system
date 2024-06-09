<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("admins")->insert(
            [
                'Firstname' => 'James',
                'Lastname' => 'Logriguez',
                'Email' => 'james@gmail.com',
                'DOB'=> '12/20/2000',
                'Phone' => '0785389000',
                'Gender' => 'male',
                'Username' => 'james@gmail.com',
                'Password' => bcrypt('password123@'),
                'Image' => 'user.png',
            ]);
    }
}
