<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();
        
        $array = [
            [ 'name' => 'Domestic Participant' ],
            [ 'name' => 'Domestic Student' ],
            [ 'name' => 'Foreign Participant' ],
            [ 'name' => 'Foreign Student' ],
        ];

        foreach ($array as $item) {
            Status::create($item);
        }
    }
}
