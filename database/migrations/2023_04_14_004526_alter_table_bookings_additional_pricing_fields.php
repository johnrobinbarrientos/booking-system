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


            $table->decimal('additional_man_per_hr', 10, 2)->change();
            $table->decimal('additional_man_per_hr_rate', 10, 2)->nullable()->after('additional_man_per_hr');
            $table->decimal('additional_man_per_hr_total', 10, 2)->nullable()->after('additional_man_per_hr_rate');

            $table->decimal('extra_time', 10, 2)->change();
            $table->decimal('travel_rate', 10, 2)->change();

            $table->decimal('overtime_per_hr_rate', 10, 2)->nullable()->after('overtime_per_hr');
            
            $table->decimal('offsite_clean_out_rate', 10, 2)->nullable()->after('offsite_clean_out');
            $table->decimal('offsite_clean_out_total', 10, 2)->nullable()->after('offsite_clean_out_rate');
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
