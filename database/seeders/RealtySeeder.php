<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('realty')->insert([
            'real_estate_branches_id' => 1,
            'owner_id' => 1,
            'realty_type_id' => 1,
            'realty_status_id' => 1,
            'cadastral_index' => 1123123,
            'qty_bedrooms' => 1,
            'qty_bathroom' => 1,
            'qty_garage' => 1,
            'qty_suite' => 1,
            'qty_pavement' => 1,
            'available' => true,
            'commission' => 5,
            'total_area' => 10.00,
            'zip_code' => 30662170,
            'address' => 'Rua X',
            'address_number' => 1,
            'neighborhood_id' => 1,
            'city_id' => 1,
            'state_id' => 1,
            'price' => 10.00,
            'rent_price' => 10.00,
            'contact_phone' => 99109123,
            'iptu_price' => 12.00,
            'registered' => 1,
            'contact_name' => 'Rafael',
            'contact_cell' => 9911212,
            'iptu_price' => 10.00
        ]);

        DB::table('realty_evaluations')->insert([
            'realty_id' => 1,
        ]);
    }
}
