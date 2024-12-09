<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_ip',
        'destination_ip',
        'packet_size',
        'protocol',
        'type',
        'rssi',
        'channel',
    ];

    protected $casts = [
        'packet_data' => 'array',
    ];

    public function aiPrediction()
    {
        return $this->hasOne(AiPrediction::class);
    }
}
