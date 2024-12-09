<?php

// app/Http/Controllers/PacketController.php

namespace App\Http\Controllers;

use App\Models\TrafficLog;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    public function index()
    {
        // Ambil 10 data packet terakhir
        $packets = TrafficLog::latest()->take(1000)->get();

        // Kirimkan data sebagai JSON
        return response()->json($packets);
    }
}
