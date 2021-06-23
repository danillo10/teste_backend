<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            'status' => 1,
            'person' => 1,
            'cpf_cnpj' => "22174454050",
            'name_social_reason' => 'Provider Name',
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
            'plan_account_id' => 1,
        ]);

        DB::table('bank_account')->insert([
            'bank_id' => 1,
            'type_account' => 1,
            'cpf_cnpj' => "46382613029",
            'agency' => "2416165",
            'account' => "2416165",
            'balance' => "5000",
        ]);

        DB::table('provider_bank_account')->insert([
            'provider_id' => 1,
            'bank_account_id' => 4,
        ]);

        DB::table('providers')->insert([
            'status' => 1,
            'person' => 1,
            'cpf_cnpj' => "44403889069",
            'name_social_reason' => 'Provider Name2',
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
            'plan_account_id' => 1,
        ]);

        DB::table('bank_account')->insert([
            'bank_id' => 1,
            'type_account' => 1,
            'cpf_cnpj' => "44403889069",
            'agency' => "8062923",
            'account' => "8062923",
            'balance' => "6000",
        ]);

        DB::table('provider_bank_account')->insert([
            'provider_id' => 2,
            'bank_account_id' => 5,
        ]);
    }
}
