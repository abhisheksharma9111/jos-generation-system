<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeOfWork extends Model
{
     use HasFactory, SoftDeletes;
    
    protected $fillable = ['name', 'rate', 'code'];
    
    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class);
    }
}
