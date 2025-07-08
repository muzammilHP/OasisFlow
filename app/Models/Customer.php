<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'customers';
    
    protected $fillable = [
        'timestamp',
        'delivery_day',
        'delivery_time',
        'customer_id',
        'full_name',
        'mobile_number',
        'alternative_mobile_number',
        'office_villa_flat_room_no',
        'street_name_building_name',
        'nearest_landmark',
        'area_name',
        'full_address',
        'geo_location_lat_long',
        'point_wkt',
        'google_map_location_link',
        'dmt_location_link',
        'lat',
        'long',
        'plus_code',
        'no_of_water_bottles_issued',
        'of_bottles_returned',
        'of_bottles_cash_received',
        'no_of_water_despenser_issued',
        'no_of_water_despenser_sold',
        'water_despenser_model_number',
        'water_despense_condition',
        'security_deposit',
        'select_product',
        'coupon_book_serial_number',
        'payment_type',
        'price',
        'pricing',
        'how_you_heard_about_us',
        'remarks',
        'email_address',
        'water_despenser_picture',
        'customer_registration_form',
        'customer_emirates_id_front',
        'customer_emirates_id_back',
        'company_trade_mark',
        'status',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'lat' => 'decimal:8',
        'long' => 'decimal:8',
        'price' => 'decimal:2',
        'pricing' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'no_of_water_bottles_issued' => 'integer',
        'of_bottles_returned' => 'integer',
        'of_bottles_cash_received' => 'integer',
        'no_of_water_despenser_issued' => 'integer',
        'no_of_water_despenser_sold' => 'integer',
    ];

    // Relationship with drivers (if you create an assignment table later)
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'assigned_driver_id', 'driver_id');
    }
}
