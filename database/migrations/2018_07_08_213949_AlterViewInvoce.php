<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterViewInvoce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW invoce AS
          SELECT c.id, nickname, sum(value) as value, month(date_buy) as month, year(date_buy) as year, c.user_id
          FROM
            invoce_credit_cards AS i JOIN credit_cards AS c ON i.credit_card_id = c.id
          GROUP BY
            month, year, nickname, c.id
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
        CREATE OR REPLACE VIEW invoce AS
          SELECT c.id, nickname, sum(value) as value, month(date_buy) as month, year(date_buy) as year
          FROM
            invoce_credit_cards AS i JOIN credit_cards AS c ON i.credit_card_id = c.id
          GROUP BY
            month, year, nickname, c.id
        ");
    }
}
