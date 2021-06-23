<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('owner')->insert([
            'name_social_reason' => $faker->name,
            'cpf_cnpj' => $faker->numberBetween($min = 11111111111, $max = 99999999999),
            'person' => 1,
            'status' => 1,
            'email' => $faker->email,
            'contact_phone' => 3133853998,
            'contact_name' => "Rafael",
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
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
