<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [ 'name' => 'guest' ],
            [ 'name' => 'admin' ],
            [ 'name' => 'superadmin' ]
        ];

        foreach ($array as $item) {
            Role::create($item);
        }
    }
}
