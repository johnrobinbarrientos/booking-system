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
            Schema::table('workers', function (Blueprint $table) {
                $table->string('first_name')->nullable()->after('id');           
                $table->string('last_name')->nullable()->after('first_name');             
                $table->string('driving_license')->nullable()->after('date_of_birth');       
                $table->date('driving_license_expiry')->nullable()->after('driving_license');       
                $table->string('hr_license')->nullable()->after('driving_license_expiry');       
                $table->date('hr_license_expiry')->nullable()->after('hr_license');       
                $table->string('white_card')->nullable()->after('hr_license_expiry');       
            });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workers', function (Blueprint $table) {
            //
        });
    }
};
