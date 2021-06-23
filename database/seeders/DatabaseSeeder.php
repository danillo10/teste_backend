<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            SuperUserSeed::class,
            PopulateAddress::class,
			//Comentar PopulateBank para rodar script dos endereços
            PopulateBank::class,
            PopulateCustomerCapture::class,
            PopulateClient::class,
            RealEstateSeeder::class,
            PlanAccountSeeder::class,
            ProviderSeeder::class,
            PartnerSeeder::class,
            OwnerSeeder::class,
            SchedulingSeeder::class,
            RealtyStatusSeeder::class,
            RealtyTypeSeeder::class,
            RealtySeeder::class,
        ]);
    }
}
