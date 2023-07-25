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
            $table->string('booking_client_name')->nullable();
            $table->string('booking_client_contact_no')->nullable();
            $table->string('booking_client_email')->nullable();
            $table->string('booking_client_address')->nullable();
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
            $table->dropColumn('booking_client_name');
            $table->dropColumn('booking_client_contact_no');
            $table->dropColumn('booking_client_email');
            $table->dropColumn('booking_client_address');
        });
    }
};
