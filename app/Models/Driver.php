<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Driver extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'drivers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'driver_id',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'vehicle_number',
        'status',
        'total_deliveries',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verification_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
        'rating' => 'decimal:2',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'driver_id';
    }

    /**
     * Check if the driver is online
     */
    public function isOnline(): bool
    {
        return $this->status === 'active' && $this->last_login_at && $this->last_login_at->diffInMinutes(now()) < 30;
    }

    /**
     * Check if the driver is on delivery
     */
    public function isOnDelivery(): bool
    {
        return $this->status === 'on_delivery';
    }

    /**
     * Get the driver's display status
     */
    public function getDisplayStatus(): string
    {
        if ($this->isOnDelivery()) {
            return 'On Delivery';
        } elseif ($this->isOnline()) {
            return 'Online';
        } else {
            return 'Offline';
        }
    }

    /**
     * Generate a unique driver ID
     */
    public static function generateDriverId(): string
    {
        $lastDriver = self::orderBy('created_at', 'desc')->first();
        
        if (!$lastDriver) {
            return 'DRV001';
        }
        
        $lastNumber = (int) substr($lastDriver->driver_id, 3);
        $newNumber = $lastNumber + 1;
        
        return 'DRV' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Increment the delivery count
     */
    public function incrementDeliveries(): void
    {
        $this->increment('total_deliveries');
    }

    /**
     * Update the driver's rating
     */
    public function updateRating(float $newRating): void
    {
        // Simple average - in a real app, you might want to implement weighted averages
        $this->rating = $newRating;
        $this->save();
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin(): void
    {
        $this->last_login_at = now();
        $this->save();
    }
}
