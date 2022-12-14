<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfitView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            create view profit30days as
              SELECT SUM( (profits.value) ) AS value,
                day(profits.created_at) AS day,
                profits.user_id
               FROM profits
              WHERE (profits.created_at >= DATE_SUB(NOW(), INTERVAL 30 day))
              GROUP BY user_id, day;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW profit30days;");
    }
}
