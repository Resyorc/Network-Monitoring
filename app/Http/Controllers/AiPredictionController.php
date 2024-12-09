<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use App\Models\TrafficLog;

class AiPredictionController extends Controller
{
    public function predict()
    {
        // Ambil data dari database (endpoint /api/packets)
        $packets = TrafficLog::all(['type', 'rssi', 'channel']);

        // Format data untuk model AI
        $formattedData = $packets->map(function ($packet) {
            return [
                $this->encodePacketType($packet->type), // Encode tipe paket
                $packet->rssi,
                $packet->channel,
            ];
        })->toArray();

        // Kirim data ke model Python
        $process = new Process(['python3', 'ai_model.py']);
        $process->setInput(json_encode($formattedData));
        $process->run();

        // Handle error
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Ambil hasil prediksi
        $predictionsJson = $process->getOutput();
        $predictions = json_decode($predictionsJson, true);

        // Debugging: Check the predictions content
        if (is_null($predictions)) {
            throw new \Exception('Predictions are null. Python script output: ' . $predictionsJson);
        }

        // Gabungkan hasil dengan data asli
        $result = $packets->map(function ($packet, $index) use ($predictions) {
            // Debugging: Check if the predictions array has the correct length
            if (!isset($predictions[$index])) {
                throw new \Exception("Prediction for index $index is missing.");
            }
            return [
                'id' => $packet->id,
                'type' => $packet->type,
                'rssi' => $packet->rssi,
                'channel' => $packet->channel,
                'prediction' => $predictions[$index], // Hasil prediksi
            ];
        });

        return response()->json($result);
    }

    private function encodePacketType($type)
    {
        $types = ['Management' => 1, 'Control' => 2, 'Data' => 3];
        return $types[$type] ?? 0;
    }
}
