<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAddressView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW address_view AS
        (
            SELECT s.id as state_id,
            s.initials as state,
            c.id as city_id,
            c.name as city,
            d.id as neighborhood_id,
            d.name as neighborhood
            FROM `state` s
            INNER JOIN `city` c on c.state_id = s.id
            INNER JOIN `neighborhood` d on d.city_id = c.id
        )"
        );
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS address_view');
    }
}
