<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderStatement extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'reference_number', 'total_job_orders', 'total_amount',
        'paid_amount', 'balance_amount', 'remarks'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->reference_number = 'JOS-' . now()->format('Ym') . '-' . str_pad(static::count() + 1, 3, '0', STR_PAD_LEFT);
            $model->balance_amount = $model->total_amount - $model->paid_amount;
        });
        
        static::updating(function ($model) {
            $model->balance_amount = $model->total_amount - $model->paid_amount;
        });
    }
    
    public function jobOrders()
    {
        return $this->belongsToMany(JobOrder::class, 'jos_job_order_links')
            ->withTimestamps();
    }
    
    // app/Models/JobOrderStatement.php

public function contractor()
{
    return $this->hasOneThrough(
        Contractor::class,
        JobOrder::class,
        'id', // Foreign key on job_orders table
        'id', // Foreign key on contractors table
        null, // Local key on job_order_statements table (not used)
        'contractor_id' // Local key on job_orders table
    );
}

public function conductor()
{
    return $this->hasOneThrough(
        Conductor::class,
        JobOrder::class,
        'id', // Foreign key on job_orders table
        'id', // Foreign key on conductors table
        null, // Local key on job_order_statements table (not used)
        'conductor_id' // Local key on job_orders table
    );
}
}
