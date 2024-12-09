<?php

// database/seeders/TrafficLogsSeeder.php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TrafficLogsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Isi data dummy ke traffic_logs
        for ($i = 0; $i < 100; $i++) {
            // Menghasilkan timestamp acak dalam rentang waktu tertentu (misalnya dalam 30 hari terakhir)
            $randomTimestamp = $faker->dateTimeBetween('-2 days', 'now')->format('Y-m-d H:i:s');

            DB::table('traffic_logs')->insert([
                'source_ip' => $faker->ipv4,
                'destination_ip' => $faker->ipv4,
                'protocol' => $faker->randomElement(['TCP', 'UDP', 'ICMP']),
                'packet_size' => $faker->numberBetween(100, 1500),
                'timestamp' => $randomTimestamp,  // Menyimpan timestamp acak
                'type' => $faker->randomElement(['Management', 'Control', 'Data']),
                'rssi' => $faker->numberBetween(-100, 0),
                'channel' => $faker->numberBetween(1, 11),
                'packet_data' => json_encode([
                    'data' => $faker->word,
                    'more_info' => $faker->sentence
                ]),
            ]);
        }
    }
}
