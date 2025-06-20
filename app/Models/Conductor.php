<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Conductor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'staff_id',
        'email',
        'phone_number',
        'department_name'
    ];

    protected $appends = ['full_name'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class);
    }

    public function getFullNameAttribute()
    {
        return trim(implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->last_name
        ])));
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($conductor) {
            // Normalize email to lowercase
            $conductor->email = Str::lower($conductor->email);
            
            // Validate uniqueness with case-insensitive check
            $existing = Conductor::withTrashed()
                ->where('email', $conductor->email)
                ->orWhere('staff_id', $conductor->staff_id)
                ->orWhere('phone_number', $conductor->phone_number)
                ->first();

            if ($existing) {
                $field = match(true) {
                    Str::lower($existing->email) === Str::lower($conductor->email) => 'email',
                    $existing->staff_id === $conductor->staff_id => 'staff ID',
                    $existing->phone_number === $conductor->phone_number => 'phone number',
                    default => 'unique identifier'
                };

                Log::error("Duplicate conductor {$field} detected", [
                    'email' => $conductor->email,
                    'staff_id' => $conductor->staff_id,
                    'phone_number' => $conductor->phone_number
                ]);

                throw new \Exception("This {$field} is already registered");
            }
        });

        static::updating(function ($conductor) {
            // Prevent changing unique fields to existing values
            if ($conductor->isDirty(['email', 'staff_id', 'phone_number'])) {
                $query = Conductor::withTrashed()
                    ->where('id', '!=', $conductor->id);

                if ($conductor->isDirty('email')) {
                    $query->where('email', Str::lower($conductor->email));
                }
                if ($conductor->isDirty('staff_id')) {
                    $query->orWhere('staff_id', $conductor->staff_id);
                }
                if ($conductor->isDirty('phone_number')) {
                    $query->orWhere('phone_number', $conductor->phone_number);
                }

                if ($query->exists()) {
                    throw new \Exception('Cannot update to an already registered identifier');
                }
            }
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('staff_id', 'like', "%{$search}%");
        });
    }
}