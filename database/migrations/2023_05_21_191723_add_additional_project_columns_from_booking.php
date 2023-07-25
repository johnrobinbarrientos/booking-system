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
            $table->string('project_none_contact_name')->nullable();
            $table->string('project_none_contact_no')->nullable();
            $table->string('project_none_contact_email')->nullable();
            $table->renameColumn('booking_project_address', 'project_none_contact_address');
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
            $table->dropColumn('project_none_contact_name');
            $table->dropColumn('project_none_contact_no');
            $table->dropColumn('project_none_contact_email');
            $table->renameColumn('project_none_contact_address', 'booking_project_address');
        });
    }
};
