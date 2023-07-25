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
            $table->decimal('min_hire',10, 2)->nullable()->after('docket_no');
            $table->decimal('extra_time', 10, 2)->nullable()->after('min_hire');
            $table->decimal('m3', 10, 2)->nullable()->after('extra_time');
            $table->decimal('pipeline_extension', 10,2)->nullable()->after('offsite_washout');
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
            //
        });
    }
};
