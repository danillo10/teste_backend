<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateAddress extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('state')->insert([
            'name' => "Minas Gerais",
            'initials' => 'MG',
        ]);

        DB::table('state')->insert([
            'name' => "Sao Paulo",
            'initials' => 'SP',
        ]);

        DB::table('city')->insert([
            'state_id' => 1,
            'name' => "Belo Horizonte",
        ]);

        DB::table('city')->insert([
            'state_id' => 2,
            'name' => "Sao Paulo",
        ]);

        DB::table('neighborhood')->insert([
            'city_id' => 2,
            'name' => "Belo Horizonte",
        ]);

        DB::table('neighborhood')->insert([
            'city_id' => 2,
            'name' => "Sao Paulo",
        ]);
    }
}
