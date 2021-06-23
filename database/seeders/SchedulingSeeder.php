<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SchedulingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('scheduling')->insert([
            'status' => 1,
            'owner_id' => 1,
            'client_id' => 1,
            'partner_id' => 1,
            'color' => '#F820178',
            'start_date' => '2020-12-23 18:50:38',
            'end_date' => '2021-01-04 18:50:38',
            'action' => 1,
            'address' => 'Rua X nuero 2',
            'note' => 'nota'
        ]);
    }
}
