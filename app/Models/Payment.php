<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id';
    public $timestamps = true;

    protected $fillable = [
        'rental_id',
        'reservation_id',
        'amount',
        'payment_type',
        'payment_method',
        'payment_date',
        'processed_by',
        'status_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime'
    ];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class, 'rental_id', 'rental_id');
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'reservation_id');
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by', 'user_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class, 'status_id', 'status_id');
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'payment_id', 'payment_id');
    }
}
