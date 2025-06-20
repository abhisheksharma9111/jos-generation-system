<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'staff_id',
        'email', 'phone_number', 'department_name'
    ];
    
    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class);
    }
    
    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }
}
