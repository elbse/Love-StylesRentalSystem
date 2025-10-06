<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RentalStatus extends Model
{
    use HasFactory;

    protected $table = 'rental_status';
    protected $primaryKey = 'status_id';
    public $timestamps = true;

    protected $fillable = [
        'status_name'
    ];

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class, 'status_id', 'status_id');
    }
}