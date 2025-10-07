<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryStatus extends Model
{
    use HasFactory;

    protected $table = 'inventory_status';
    protected $primaryKey = 'status_id';
    public $timestamps = true;

    protected $fillable = [
        'status_name'
    ];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'status_id', 'status_id');
    }
}