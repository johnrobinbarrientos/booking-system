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
        Schema::create('pump_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_group_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pump_category_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('size')->nullable();
            $table->decimal('min_hire_first_2_hours_on_site',10,2);
            $table->decimal('extra_time_per_hour',10,2);
            $table->decimal('per_cube_meter_of_concrete',10,2);
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('pump_prices');
    }
};
