<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopulateClient extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'person' => 1,
            'name_social_reason' => "Padrex LTDA",
            'cpf_cnpj' => "02060339669",
            'status' => 1,
            'email' => "rafael@teste.com.br",
            'income_revenues' => "3",
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
            'cpf_cnpj' => "02060339669",
            'agency' => "123123",
            'account' => "123123",
            'balance' => "3000",
        ]);

        DB::table('client_bank_account')->insert([
            'client_id' => 1,
            'bank_account_id' => 1,
        ]);
    }
}
