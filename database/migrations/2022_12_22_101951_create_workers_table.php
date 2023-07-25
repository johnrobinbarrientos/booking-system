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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();                 
            $table->string('contact_number')->nullable();           
            $table->string('email')->nullable();           
            $table->date('date_of_birth')->nullable();        
            $table->string('roles')->nullable();           
            $table->string('emergency_contact_name')->nullable();           
            $table->string('emergency_contact_number')->nullable();    
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
};
