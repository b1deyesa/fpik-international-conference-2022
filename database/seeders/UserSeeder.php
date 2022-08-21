<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $array = [
            [ 
                'status_id' => '1',
                'role_id'   => '2', 
                'name'      => 'admin', 
                'email'     => 'admin@icsic.com', 
                'password'  => Hash::make('#ADMIN?ICSIC22'), 
            ]
        ];

        foreach ($array as $item) {
            User::create($item);
        }
    }
}
