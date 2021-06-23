<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealtyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('realty_type')->insert([
            'name' => 'Apartamento',
        ]);

        DB::table('realty_type')->insert([
            'name' => 'Casa',
        ]);

        DB::table('realty_type')->insert([
            'name' => 'Quitinete',
        ]);

        DB::table('realty_type')->insert([
            'name' => 'Galpão',
        ]);
    }
}
