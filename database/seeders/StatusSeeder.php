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
        $array = [
            [ 'name' => 'General' ],
            [ 'name' => 'Student' ],
            [ 'name' => 'Researcher' ],
            [ 'name' => 'Lecturers' ],
            [ 'name' => 'Presenter - Domestic' ],
            [ 'name' => 'Presenter - International' ]
        ];

        foreach ($array as $item) {
            Status::create($item);
        }
    }
}
