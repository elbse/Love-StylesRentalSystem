<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rental extends Model
{
    use HasFactory;

    protected $primaryKey = 'rental_id';
    public $timestamps = true;

    protected $fillable = [
        'reservation_id',
        'released_by',
        'released_date',
        'due_date',
        'return_date',
        'status_id',
        'penalty_fee'
    ];

    protected $casts = [
        'released_date' => 'datetime',
        'due_date' => 'datetime',
        'return_date' => 'datetime',
        'penalty_fee' => 'decimal:2'
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'reservation_id');
    }

    public function releasedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'released_by', 'user_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(RentalStatus::class, 'status_id', 'status_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'rental_id', 'rental_id');
    }
}
