<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('price_groups', function (Blueprint $table) {
            $table->decimal('additional_man_per_hour',10,2);
            $table->decimal('overtime_per_hour_per_man',10,2);
            $table->decimal('offsite_clean_out',10,2);
            //$table->decimal('cement_bag',10,2);
            //$table->decimal('pipeline_extension',10,2);
            //$table->decimal('washout_bag',10,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('price_groups', function (Blueprint $table) {
            //
        });
    }
};
