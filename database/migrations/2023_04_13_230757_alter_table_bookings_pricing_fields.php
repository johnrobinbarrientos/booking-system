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

            $table->decimal('total_hours', 10, 2)->change();
            $table->decimal('total_hours_rate', 10, 2)->nullable()->after('total_hours');
            $table->decimal('total_hours_total', 10, 2)->nullable()->after('total_hours_rate');
            
            $table->decimal('metres_pumped', 10, 2)->change();
            $table->decimal('metres_pumped_rate', 10, 2)->nullable()->after('metres_pumped');
            $table->decimal('metres_pumped_total', 10, 2)->nullable()->after('metres_pumped_rate');

            $table->decimal('extra_man', 10, 2)->change();
            $table->renameColumn('extra_man', 'additional_man_per_hr');


            $table->decimal('penalties', 10, 2)->change();
            $table->renameColumn('penalties', 'overtime_per_hr');
            $table->dropColumn(['penalty_rate']);
            $table->decimal('total_penalty', 10, 2)->change();
            $table->renameColumn('total_penalty', 'overtime_per_hr_total');

            $table->dropColumn(['extra_time']);
            
            $table->renameColumn('extra_line', 'extra_time');
            $table->decimal('extra_line_rate', 10, 2)->change();
            $table->renameColumn('extra_line_rate', 'extra_time_rate');
            $table->decimal('total_extra_line', 10, 2)->change();
            $table->renameColumn('total_extra_line', 'extra_time_total');

            $table->decimal('travel', 10, 2)->change();
            $table->decimal('travel_fee', 10, 2)->change();
            $table->renameColumn('travel_fee', 'travel_rate');
            $table->decimal('total_travel', 10, 2)->change();
            $table->renameColumn('total_travel', 'travel_total');

            $table->decimal('washout_bag', 10, 2)->change();
            $table->decimal('washout_bag_rate', 10, 2)->nullable()->after('washout_bag');
            $table->decimal('washout_bag_total', 10, 2)->nullable()->after('washout_bag_rate');

            $table->decimal('cement_bag', 10, 2)->change();
            $table->decimal('cement_bag_rate', 10, 2)->nullable()->after('cement_bag');
            $table->decimal('cement_bag_total', 10, 2)->nullable()->after('cement_bag_rate');

            $table->decimal('offsite_washout', 10, 2)->change();
            $table->renameColumn('offsite_washout', 'offsite_clean_out');
           

            $table->decimal('pipeline_extension', 10, 2)->change();
            $table->decimal('pipeline_extension_rate', 10, 2)->nullable()->after('pipeline_extension');
            $table->decimal('pipeline_extension_total', 10, 2)->nullable()->after('pipeline_extension_rate');

            $table->decimal('sundries1', 10, 2)->change();
            $table->decimal('sundries1_rate', 10, 2)->nullable()->after('sundries1');
            $table->decimal('sundries1_total', 10, 2)->nullable()->after('sundries1_rate');

            $table->decimal('sundries2', 10, 2)->change();
            $table->decimal('sundries2_rate', 10, 2)->nullable()->after('sundries2');
            $table->decimal('sundries2_total', 10, 2)->nullable()->after('sundries2_rate');

            $table->decimal('total_amount_without_gst', 10, 2)->change();
            $table->renameColumn('total_amount_without_gst', 'ex_gst');            

            $table->decimal('gst', 10, 2)->change();

            $table->decimal('grand_total', 10, 2)->change();

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
            //
        });
    }
};
