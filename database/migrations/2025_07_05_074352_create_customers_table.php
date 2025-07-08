<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp')->nullable();
            $table->string('delivery_day')->nullable();
            $table->time('delivery_time')->nullable();
            $table->string('customer_id')->unique();
            $table->string('full_name');
            $table->string('mobile_number');
            $table->string('alternative_mobile_number')->nullable();
            $table->string('office_villa_flat_room_no')->nullable();
            $table->string('street_name_building_name')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->string('area_name')->nullable();
            $table->text('full_address');
            $table->string('geo_location_lat_long')->nullable();
            $table->text('point_wkt')->nullable();
            $table->text('google_map_location_link')->nullable();
            $table->text('dmt_location_link')->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('long', 11, 8)->nullable();
            $table->string('plus_code')->nullable();
            $table->integer('no_of_water_bottles_issued')->nullable();
            $table->integer('of_bottles_returned')->nullable();
            $table->integer('of_bottles_cash_received')->nullable();
            $table->integer('no_of_water_despenser_issued')->nullable();
            $table->integer('no_of_water_despenser_sold')->nullable();
            $table->string('water_despenser_model_number')->nullable();
            $table->string('water_despense_condition')->nullable();
            $table->decimal('security_deposit', 10, 2)->nullable();
            $table->string('select_product')->nullable();
            $table->string('coupon_book_serial_number')->nullable();
            $table->enum('payment_type', ['cash', 'card', 'online', 'bank_transfer'])->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('pricing', 10, 2)->nullable();
            $table->string('how_you_heard_about_us')->nullable();
            $table->text('remarks')->nullable();
            $table->string('email_address')->nullable();
            $table->string('water_despenser_picture')->nullable();
            $table->string('customer_registration_form')->nullable();
            $table->string('customer_emirates_id_front')->nullable();
            $table->string('customer_emirates_id_back')->nullable();
            $table->string('company_trade_mark')->nullable();
            $table->enum('status', ['pending', 'delivered', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
