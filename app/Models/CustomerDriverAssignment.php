<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerDriverAssignment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'driver_id',
        'assigned_at',
        'assigned_by',
        'status',
        'notes',
        'unassigned_at',
        'unassigned_by',
    ];
    
    protected $casts = [
        'assigned_at' => 'datetime',
        'unassigned_at' => 'datetime',
    ];
    
    /**
     * Get the customer associated with this assignment.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
    
    /**
     * Get the driver associated with this assignment.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'driver_id');
    }
}
