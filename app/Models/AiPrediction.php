<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'traffic_log_id',
        'prediction',
        'confidence_score',
    ];

    public function trafficLog()
    {
        return $this->belongsTo(TrafficLog::class);
    }
}
