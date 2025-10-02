<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'full_name',
        'email',
        'address',
        'contact_number',
        'measurement',
        'status_id',
    ];

    protected $casts = [
        'measurement' => 'array',
    ];

    public function status()
    {
        return $this->belongsTo(CustomerStatus::class, 'status_id');
    }

    
}
