<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealtyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('realty_status')->insert([
            'name' => 'Planta',
        ]);

        DB::table('realty_status')->insert([
            'name' => 'Pre-Lançamento',
        ]);

        DB::table('realty_status')->insert([
            'name' => 'Lançamento',
        ]);

        DB::table('realty_status')->insert([
            'name' => 'Pronto',
        ]);
    }
}
