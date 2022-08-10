<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'fullname' => 'rokiadhytama',
                'username' => 'roki',
                'email' => 'roki@gmail.com',
                'password' => Hash::make(123456),
            ],
        ];

        User::insert($data);
    }
}
