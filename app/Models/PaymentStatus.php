<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $table = 'payment_status';
    protected $primaryKey = 'status_id';
    public $timestamps = true;

    protected $fillable = [
        'status_name'
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'status_id', 'status_id');
    }
}