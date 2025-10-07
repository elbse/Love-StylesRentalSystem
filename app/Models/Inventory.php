<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';
    public $timestamps = true;

    protected $fillable = [
        'item_type',
        'name',
        'size',
        'color',
        'design',
        'rental_price',
        'item_condition',
        'status_id'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(InventoryStatus::class, 'status_id', 'status_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'item_id', 'item_id');
    }
}
