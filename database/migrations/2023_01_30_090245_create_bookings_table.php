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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->nullable()->unique();
            $table->date('job_date')->nullable();
            $table->date('date_booked')->nullable();
            $table->string('booking_status')->nullable();
            $table->string('job_description')->nullable();
            $table->time('job_start_time')->nullable();
            $table->time('concrete_time')->nullable();
            $table->string('metres_to_pump')->nullable();
            $table->string('concrete_mix')->nullable();
            $table->string('job_notes')->nullable();
            $table->string('concrete_supplier')->nullable();
            $table->string('concrete_type')->nullable();
            $table->string('docket_no')->nullable();
            //$table->string('min_hire')->nullable();
            //$table->string('extra_time')->nullable();
            //$table->string('m3')->nullable();
            $table->time('time_onsite')->nullable();
            $table->time('time_offsite')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('metres_pumped')->nullable();
            $table->decimal('cement_bag', 10, 2)->nullable();
            $table->decimal('fuel_levy', 10, 2)->nullable();
            $table->integer('extra_man')->nullable();
            $table->decimal('labour_rate', 10,2)->nullable();
            $table->decimal('total_labour',10,2)->nullable();
            $table->string('penalties')->nullable();
            $table->decimal('penalty_rate', 10,2)->nullable();
            $table->decimal('total_penalty', 10, 2)->nullable();
            $table->string('extra_line')->nullable();
            $table->decimal('extra_line_rate', 10, 2)->nullable();
            $table->decimal('total_extra_line', 10,2)->nullable();
            $table->string('travel')->nullable();
            $table->string('travel_fee', 10, 2)->nullable();
            $table->decimal('total_travel', 10, 2)->nullable();
            $table->integer('washout_bag')->nullable();
            $table->decimal('cost_per_bag', 10, 2)->nullable();
            $table->decimal('offsite_washout', 10,2)->nullable();
            //$table->decimal('pipeline_extension', 10,2)->nullable();
            $table->decimal('gst', 10, 2)->nullable();
            $table->decimal('extra_time_per_hour_cost',10,2)->nullable();
            $table->decimal('per_cube_meter_of_concrete',10,2)->nullable();
            $table->decimal('total_amount_without_gst',10,2)->nullable();
            $table->string('sundries1')->nullable();
            $table->string('sundries2')->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->decimal('min_hire_cost',10,2)->nullable();
            $table->decimal('total_washout_bag',10,2)->nullable();
            $table->boolean('job_check_required')->default(false);
            $table->boolean('mark_as_complete')->default(false);
            $table->string('job_check_info')->nullable();
            //foreign keys
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('pump_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('price_group_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('pump_category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('pump_price_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('subbie_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('bookings');
    }
};
