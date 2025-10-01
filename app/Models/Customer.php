<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
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

    
}
