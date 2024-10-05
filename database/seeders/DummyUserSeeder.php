<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [

                'name'=> 'AdminFad',
                'nis'=> '222310229',
                'role' => 'admin',
                'password' => bcrypt('12345678')

            ]
            ];

            foreach ($userData as $key => $val){
                User::create($val);
            }
    }
}
