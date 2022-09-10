<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterViewProfit30Days extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE view profit30days as
                SELECT SUM( (profits.value) ) AS value,
                    EXTRACT(DAY FROM profits.date_operation) AS day,
                    profits.user_id
                FROM profits
                WHERE (profits.date_operation >= DATE_SUB(NOW(), INTERVAL 30 day))
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
        DB::statement("
            CREATE OR REPLACE view profit30days as
            SELECT SUM( (profits.value) ) AS value,
                EXTRACT(DAY FROM profits.date_operation) AS day,
                profits.user_id
            FROM profits
            WHERE (profits.date_operation >= DATE_SUB(NOW(), INTERVAL 30 day))
            GROUP BY user_id, day;
        ");
    }
}
