<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contractor extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name', 'code', 'email', 'phone_number', 
        'company_name', 'balance'
    ];
    
    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class);
    }
    
    public function jobOrderStatements()
    {
        return $this->hasManyThrough(
            JobOrderStatement::class,
            JobOrder::class
        );
    }
}
