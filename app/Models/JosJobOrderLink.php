<?php

// app/Models/JosJobOrderLink.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JosJobOrderLink extends Model
{
    protected $fillable = [
        'job_order_statement_id',
        'job_order_id'
    ];
    
    // If you're using timestamps
    public $timestamps = true;
}
