<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReservationStatus extends Model
{
    use HasFactory;

    protected $table = 'reservation_status';
    protected $primaryKey = 'status_id';
    public $timestamps = true;

    protected $fillable = [
        'status_name'
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'status_id', 'status_id');
    }
}