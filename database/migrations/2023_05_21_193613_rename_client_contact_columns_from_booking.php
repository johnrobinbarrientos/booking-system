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
            $table->renameColumn('booking_client_name', 'client_none_contact_name');
            $table->renameColumn('booking_client_contact_no', 'client_none_contact_no');
            $table->renameColumn('booking_client_email', 'client_none_contact_email');
            $table->renameColumn('booking_client_address', 'client_none_contact_address');
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
            $table->renameColumn('client_none_contact_name', 'booking_client_name');
            $table->renameColumn('client_none_contact_no', 'booking_client_contact_no');
            $table->renameColumn('client_none_contact_email', 'booking_client_email');
            $table->renameColumn('client_none_contact_address', 'booking_client_address');
        });
    }
};
