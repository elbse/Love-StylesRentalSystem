<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservation_id';
    public $timestamps = true;

    protected $fillable = [
        'customer_id',
        'item_id',
        'reserved_by',
        'reservation_date',
        'status_id',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'reservation_date' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'item_id', 'item_id');
    }

    public function reservedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reserved_by', 'user_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ReservationStatus::class, 'status_id', 'status_id');
    }

    public function rental(): HasOne
    {
        return $this->hasOne(Rental::class, 'reservation_id', 'reservation_id');
    }
}
