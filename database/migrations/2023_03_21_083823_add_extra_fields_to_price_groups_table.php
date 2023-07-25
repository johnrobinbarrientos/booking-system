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
            $table->decimal('cement_bag',10,2)->nullable()->after('offsite_clean_out');
            $table->decimal('pipeline_extension',10,2)->nullable()->after('cement_bag');
            $table->decimal('washout_bag',10,2)->nullable()->after('pipeline_extension');
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
            $table->decimal('cement_bag',10,2);
            $table->decimal('pipeline_extension',10,2);
            $table->decimal('washout_bag',10,2);
        });
    }
};
