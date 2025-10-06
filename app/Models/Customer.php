<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = 'customer_id';
    public $incrementing = true;
    protected $keyType = 'int';

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

    // Scope for filtering and fuzzy searching
    public function scopeFilter($query, array $filters)
    {
        $search = isset($filters['q']) ? trim((string) $filters['q']) : '';
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%");
            });
        }

        // Optional exact or partial filters
        if (!empty($filters['status'])) {
            $status = $filters['status'];
            // allow status by name via relation
            $query->whereHas('status', function ($q) use ($status) {
                $q->where('status_name', 'like', "%{$status}%");
            });
        }

        if (!empty($filters['email'])) {
            $email = trim((string) $filters['email']);
            $query->where('email', 'like', "%{$email}%");
        }

        if (!empty($filters['contact'])) {
            $contact = trim((string) $filters['contact']);
            $query->where('contact_number', 'like', "%{$contact}%");
        }

        if (!empty($filters['name'])) {
            $name = trim((string) $filters['name']);
            $query->where('full_name', 'like', "%{$name}%");
        }

        return $query;
    }
}
