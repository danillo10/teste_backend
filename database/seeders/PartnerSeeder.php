<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $faker = Faker::create();

        DB::table('partners')->insert([
            'name_social_reason' => $faker->name,
            'cpf_cnpj' => $faker->numberBetween($min = 11111111111, $max = 99999999999),
            'person' => 1,
            'profile_partner' => 1,
            'status' => 1,
            'email' => $faker->email,
            'creci_number' => '00000123',
            'creci_data' => 'creci0000124.png',
            'contact_name' => 'Contato do Creci',            
            'percentage_commission' => '10',
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
            'cpf_cnpj' => $faker->numberBetween($min = 11111111111, $max = 99999999999),
            'agency' => $faker->numberBetween($min = 123212, $max = 989878),
            'account' => $faker->numberBetween($min = 123212, $max = 989878),
            'balance' => "3000",
        ]);

        DB::table('partner_bank_account')->insert([
            'partner_id' => 1,
            'bank_account_id' => 6,
        ]);

        DB::table('partners')->insert([
            'name_social_reason' => $faker->name,
            'cpf_cnpj' => $faker->numberBetween($min = 11111111111, $max = 99999999999),
            'person' => 1,
            'profile_partner' => 2,
            'status' => 1,
            'email' => $faker->email,
            'creci_number' => '00000124',
            'creci_data' => 'creci0000124.png',
            'contact_name' => 'Contato do Creci',
            'fixed_commission' => '150',
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
            'cpf_cnpj' => $faker->numberBetween($min = 11111111111, $max = 99999999999),
            'agency' => $faker->numberBetween($min = 123212, $max = 989878),
            'account' => $faker->numberBetween($min = 123212, $max = 989878),
            'balance' => "3000",
        ]);

        DB::table('partner_bank_account')->insert([
            'partner_id' => 2,
            'bank_account_id' => 7,
        ]);
    }
}
