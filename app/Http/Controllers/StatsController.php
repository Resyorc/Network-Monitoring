<?php

// app/Http/Controllers/StatsController.php

namespace App\Http\Controllers;

use App\Models\TrafficLog;
use App\Models\AiPrediction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        // Hitung total packet
        $totalPackets = TrafficLog::count();

        // Hitung traffic yang sudah dianalisa (ada prediksi AI)
        $analyzedTraffic = AiPrediction::count();

        // Hitung alerts (prediksi anomali)
        $alerts = AiPrediction::where('prediction', 'anomaly')->count();

        // Hitung normal traffic (prediksi normal)
        $normalTraffic = AiPrediction::where('prediction', 'normal')->count();

        // Ambil jumlah paket per timestamp (misalnya per jam)

        $trafficPerTime = TrafficLog::selectRaw('MIN(timestamp) as timestamp, COUNT(*) as total_packets')
            ->groupByRaw('DATE_FORMAT(timestamp, "%Y-%m-%d %H:00:00")')
            ->orderBy('timestamp', 'asc')
            ->get();

        // Format data untuk frontend
        $formattedTraffic = $trafficPerTime->map(function ($item) {
            return [
                'timestamp' => $item->timestamp,
                'totalPackets' => $item->total_packets
            ];
        });

        // Kirimkan data sebagai JSON
        return response()->json([
            'totalPackets' => $totalPackets,
            'analyzedTraffic' => $analyzedTraffic,
            'alerts' => $alerts,
            'normalTraffic' => $normalTraffic,
            'trafficOverTime' => $formattedTraffic // Data jumlah paket per waktu
        ]);
    }
}
