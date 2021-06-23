<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateCustomerCapture extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_capture')->insert([
            'name' => 'Facebook',
        ]);

        DB::table('customer_capture')->insert([
            'name' => 'Instagram',
        ]);

        DB::table('customer_capture')->insert([
            'name' => 'Porta de loja',
        ]);
    }
}
