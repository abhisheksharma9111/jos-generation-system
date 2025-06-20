<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOrder extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'date',
        'jos_date',
        'type_of_work_id',
        'contractor_id',
        'conductor_id',
        'actual_work_completed',
        'remarks'
    ];

    // Add this to properly cast date fields
    protected $casts = [
        'date' => 'date:Y-m-d',
        'jos_date' => 'date:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Add this to cast dates properly
    protected $dates = ['date', 'jos_date'];

   

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($jobOrder) {
            
            $date = $jobOrder->date->format('Ymd');

            
            $lastOrder = static::withTrashed()
                ->where('reference_number', 'like', "JO-{$date}-%")
                ->orderBy('reference_number', 'desc')
                ->first();

            $number = $lastOrder
                ? (int) substr($lastOrder->reference_number, -3) + 1
                : 1;

            $jobOrder->reference_number = sprintf("JO-%s-%03d", $date, $number);
        });
    }

    public function typeOfWork()
    {
        return $this->belongsTo(TypeOfWork::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }

    public function jobOrderStatement()
    {
        return $this->hasOneThrough(
            JobOrderStatement::class,
            JosJobOrderLink::class,
            'job_order_id',
            'id',
            'id',
            'job_order_statement_id'
        );
    }

    public function getAmountAttribute()
    {
        return $this->actual_work_completed * $this->typeOfWork->rate;
    }
}
