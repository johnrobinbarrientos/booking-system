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
        Schema::create('pumps', function (Blueprint $table) {
            $table->id();
            $table->string('pump_name')->nullable();           
            $table->string('plant_number')->nullable();           
            $table->string('registration')->nullable();           
            $table->text('location')->nullable();           
            $table->integer('year')->nullable();                   
            $table->string('model')->nullable();           
            $table->integer('capacity')->unsigned()->nullable();           
            $table->string('serial_no')->nullable();           
            $table->string('worksafe_no')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('pumps');
    }
};
