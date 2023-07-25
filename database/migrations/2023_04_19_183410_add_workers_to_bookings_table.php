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
        Schema::table('bookings', function (Blueprint $table) {
            $table->bigInteger('worker_operator_id')->nullable();
            $table->bigInteger('worker_hoseman_id')->nullable();
            $table->bigInteger('worker_extraman1_id')->nullable();
            $table->bigInteger('worker_extraman2_id')->nullable();
            $table->bigInteger('worker_extraman3_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('worker_operator_id');
            $table->dropColumn('worker_hoseman_id');
            $table->dropColumn('worker_extraman1_id');
            $table->dropColumn('worker_extraman2_id');
            $table->dropColumn('worker_extraman3_id');
        });
    }
};
