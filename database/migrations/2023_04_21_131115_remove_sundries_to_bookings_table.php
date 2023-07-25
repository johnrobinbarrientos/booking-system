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
            $table->dropColumn(['sundries1', 'sundries1_rate', 'sundries1_total']);
            $table->dropColumn(['sundries2', 'sundries2_rate', 'sundries2_total']);
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
            $table->decimal('sundries1', 10, 2)->change();
            $table->decimal('sundries1_rate', 10, 2)->nullable()->after('sundries1');
            $table->decimal('sundries1_total', 10, 2)->nullable()->after('sundries1_rate');

            $table->decimal('sundries2', 10, 2)->change();
            $table->decimal('sundries2_rate', 10, 2)->nullable()->after('sundries2');
            $table->decimal('sundries2_total', 10, 2)->nullable()->after('sundries2_rate');
        });
    }
};
