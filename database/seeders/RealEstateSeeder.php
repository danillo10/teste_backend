<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('real_estate_agencies')->insert([
            'social_reason' => "Padrex LTDA",
            'cnpj' => "02060339669",
        ]);

        DB::table('real_estate_branches')->insert([
            'real_estate_agencies_id' => 1,
            'cnpj' => '02060339669',
            'is_agency' => true,
            'social_reason' => 'Padrex LTDA',
            'creci_number' => '000001',
            'creci_data' => 'creci001.png',
            'email' => "rafael@teste.com.br",
            'contact_name' => "Rafael Angelo",
            'contact_phone' => 3133853998,
            'contact_cell' => 31991095370,
            'zip_code' => 30662170,
            'address' => "Rua X",
            'address_number' => 22,
            'reference_point' => "Perto",
            'complement' => "Casa",
            'neighborhood_id' => 1,
            'city_id' => 1,
            'state_id' => 1,
            'customer_capture_id' => 1,
        ]);

        DB::table('bank_account')->insert([
            'bank_id' => 1,
            'type_account' => 1,
            'cpf_cnpj' => "96465599058",
            'agency' => "3387599",
            'account' => "3387599",
            'balance' => "3000",
        ]);

        DB::table('real_estate_bank_account')->insert([
            'real_estate_branches_id' => 1,
            'bank_account_id' => 2,
        ]);

        DB::table('real_estate_branches')->insert([
            'real_estate_agencies_id' => 1,
            'cnpj' => '020603396691',
            'is_agency' => false,
            'social_reason' => 'Padrex2 LTDA',
            'creci_number' => '0000012',
            'creci_data' => 'creci0012.png',
            'email' => "rafael2@teste.com.br",
            'contact_name' => "Rafael Angelo",
            'contact_phone' => 3133853998,
            'contact_cell' => 31991095370,
            'zip_code' => 30662170,
            'address' => "Rua X",
            'address_number' => 22,
            'reference_point' => "Perto",
            'complement' => "Casa",
            'neighborhood_id' => 1,
            'city_id' => 1,
            'state_id' => 1,
            'customer_capture_id' => 1,
        ]);

        DB::table('bank_account')->insert([
            'bank_id' => 1,
            'type_account' => 1,
            'cpf_cnpj' => "83306468070",
            'agency' => "5396391",
            'account' => "5396391",
            'balance' => "4000",
        ]);

        DB::table('real_estate_bank_account')->insert([
            'real_estate_branches_id' => 2,
            'bank_account_id' => 3,
        ]);
    }
}
