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
            $table->renameColumn('total_hours', 'min_hire')->after('time_offsite');
            $table->renameColumn('total_hours_rate', 'min_hire_rate');
            $table->renameColumn('total_hours_total', 'min_hire_total'); 
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
            $table->renameColumn('min_hire', 'total_hours');
            $table->renameColumn('min_hire_rate', 'total_hours_rate');
            $table->renameColumn('min_hire_total', 'total_hours_total'); 
        });
    }
};
