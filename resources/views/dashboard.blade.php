{{-- <!doctype html> --}}
{{-- <html lang="en"> --}}
{{-- --}}
{{-- <head> --}}
{{--     <meta charset="UTF-8"> --}}
{{--     <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
{{--     <title>Network Traffic Monitoring Dashboard</title> --}}
{{--     @vite('resources/css/app.css') --}}
{{--     <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
{{--     <script> --}}
{{--         document.addEventListener("alpine:init", () => { --}}
{{--             Alpine.store("dashboard", { --}}
{{--                 packets: [], --}}
{{--                 async fetchPackets() { --}}
{{--                     const response = await fetch("/api/packets"); --}}
{{--                     this.packets = await response.json(); --}}
{{--                 }, --}}
{{--             }); --}}
{{--         }); --}}
{{--     </script> --}}
{{-- </head> --}}
{{-- --}}
{{-- <body class="bg-gray-100 font-sans leading-normal tracking-normal"> --}}
{{--     <header class="bg-gray-800 text-white p-4 text-center"> --}}
{{--         <h1 class="text-2xl font-bold">Network Traffic Monitoring Dashboard</h1> --}}
{{--     </header> --}}
{{-- --}}
{{--     <div class="container mx-auto py-6"> --}}
{{--         <!-- Stats Panel --> --}}
{{-- --}}
{{--         <div class="grid grid-cols-4 gap-4 mb-6" x-data="{ stats: {} }" x-init="fetch('/api/stats') --}}
{{--             .then(response => response.json()) --}}
{{--             .then(data => stats = data)"> --}}
{{--             <div class="bg-white p-4 shadow rounded text-center"> --}}
{{--                 <h2 class="text-lg font-semibold">Total Packets</h2> --}}
{{--                 <p x-text="stats.totalPackets || 0" class="text-xl font-bold text-gray-800"></p> --}}
{{--             </div> --}}
{{--             <div class="bg-white p-4 shadow rounded text-center"> --}}
{{--                 <h2 class="text-lg font-semibold">Analyzed Traffic</h2> --}}
{{--                 <p x-text="stats.analyzedTraffic || 0" class="text-xl font-bold text-gray-800"></p> --}}
{{--             </div> --}}
{{--             <div class="bg-white p-4 shadow rounded text-center"> --}}
{{--                 <h2 class="text-lg font-semibold">Alerts</h2> --}}
{{--                 <p x-text="stats.alerts || 0" class="text-xl font-bold text-red-600"></p> --}}
{{--             </div> --}}
{{--             <div class="bg-white p-4 shadow rounded text-center"> --}}
{{--                 <h2 class="text-lg font-semibold">Normal Traffic</h2> --}}
{{--                 <p x-text="stats.normalTraffic || 0" class="text-xl font-bold text-green-600"></p> --}}
{{--             </div> --}}
{{--         </div> --}}
{{-- --}}
{{-- --}}
{{--         <!-- Traffic Chart --> --}}
{{--         <div class="bg-white p-6 shadow rounded mb-6"> --}}
{{--             <h2 class="text-lg font-semibold mb-4">Network Traffic Over Time</h2> --}}
{{--             <canvas id="traffic-chart" width="400" height="200"></canvas> --}}
{{--         </div> --}}
{{-- --}}
{{--         <!-- Alerts Section --> --}}
{{--         <div class="bg-yellow-200 text-yellow-900 font-bold p-4 mb-6 text-center rounded" x-data="{ alertMessage: 'No issues detected', predictions: [] }" --}}
{{--             x-init="fetch('/api/ai-predictions') --}}
{{--                 .then(response => response.json()) --}}
{{--                 .then(data => { --}}
{{--                     predictions = data; --}}
{{--                     if (predictions.some(prediction => prediction.prediction === 'anomaly')) { --}}
{{--                         alertMessage = 'Warning! Anomalies detected in network traffic.'; --}}
{{--                     } --}}
{{--                 })"> --}}
{{--             <p x-text="alertMessage"></p> --}}
{{--         </div> --}}
{{-- --}}
{{--         <!-- Captured Packets Table --> --}}
{{--         <div class="bg-white p-6 shadow rounded"> --}}
{{--             <h2 class="text-lg font-semibold mb-4">Captured Packets</h2> --}}
{{--             <table class="min-w-full bg-white border border-gray-200 rounded"> --}}
{{--                 <thead> --}}
{{--                     <tr class="bg-gray-800 text-white"> --}}
{{--                         <th class="py-2 px-4 border">Source IP</th> --}}
{{--                         <th class="py-2 px-4 border">Destination IP</th> --}}
{{--                         <th class="py-2 px-4 border">Packet Size</th> --}}
{{--                         <th class="py-2 px-4 border">Protocol</th> --}}
{{--                         <th class="py-2 px-4 border">Timestamp</th> --}}
{{--                     </tr> --}}
{{--                 </thead> --}}
{{--                 <tbody x-data="$store.dashboard" x-init="fetchPackets"> --}}
{{--                     <template x-for="packet in packets" :key="packet.id"> --}}
{{--                         <tr class="text-center border-t hover:bg-gray-100"> --}}
{{--                             <td class="py-2 px-4" x-text="packet.source_ip"></td> --}}
{{--                             <td class="py-2 px-4" x-text="packet.destination_ip"></td> --}}
{{--                             <td class="py-2 px-4" x-text="packet.packet_size"></td> --}}
{{--                             <td class="py-2 px-4" x-text="packet.protocol"></td> --}}
{{--                             <td class="py-2 px-4" x-text="packet.timestamp"></td> --}}
{{--                         </tr> --}}
{{--                     </template> --}}
{{--                 </tbody> --}}
{{--             </table> --}}
{{--         </div> --}}
{{--     </div> --}}
{{-- --}}
{{--     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
{{--     <script> --}}
{{--         document.addEventListener("DOMContentLoaded", async () => { --}}
{{--             // Ambil data dari API --}}
{{--             const response = await fetch('/api/stats'); --}}
{{--             const stats = await response.json(); --}}
{{-- --}}
{{--             // Ekstrak trafficOverTime dari respons API --}}
{{--             const trafficData = stats.trafficOverTime || []; --}}
{{-- --}}
{{--             // Data untuk chart --}}
{{--             const chartData = { --}}
{{--                 labels: trafficData.map((item) => item.timestamp), // Waktu --}}
{{--                 datasets: [{ --}}
{{--                     label: "Traffic Over Time", --}}
{{--                     data: trafficData.map((item) => item.totalPackets), // Total Packets --}}
{{--                     borderColor: "rgba(75, 192, 192, 1)", --}}
{{--                     backgroundColor: "rgba(75, 192, 192, 0.2)", --}}
{{--                     fill: true, --}}
{{--                 }, ], --}}
{{--             }; --}}
{{-- --}}
{{--             // Opsi konfigurasi chart --}}
{{--             const options = { --}}
{{--                 responsive: true, --}}
{{--                 aspectRatio: 5, --}}
{{--                 maintainAspectRatio: true, --}}
{{--                 plugins: { --}}
{{--                     legend: { --}}
{{--                         display: true, --}}
{{--                         position: "top", --}}
{{--                     }, --}}
{{--                 }, --}}
{{--                 scales: { --}}
{{--                     x: { --}}
{{--                         type: "category", --}}
{{--                         title: { --}}
{{--                             display: true, --}}
{{--                             text: "Timestamp", --}}
{{--                         }, --}}
{{--                         ticks: { --}}
{{--                             callback: function(value, index, ticks) { --}}
{{--                                 // Format waktu jika diperlukan --}}
{{--                                 return this.getLabelForValue(value).substring(11, --}}
{{--                                     16); // Hanya tampilkan jam dan menit --}}
{{--                             }, --}}
{{--                             color: "#333", --}}
{{--                         }, --}}
{{--                     }, --}}
{{--                     y: { --}}
{{--                         title: { --}}
{{--                             display: true, --}}
{{--                             text: "Total Packets", --}}
{{--                         }, --}}
{{--                         ticks: { --}}
{{--                             color: "#333", --}}
{{--                         }, --}}
{{--                     }, --}}
{{--                 }, --}}
{{--             }; --}}
{{-- --}}
{{--             // Inisialisasi chart --}}
{{--             const ctx = document.getElementById("traffic-chart").getContext("2d"); --}}
{{--             new Chart(ctx, { --}}
{{--                 type: "line", --}}
{{--                 data: chartData, --}}
{{--                 options: options, --}}
{{--             }); --}}
{{--         }); --}}
{{--     </script> --}}
{{-- </body> --}}
{{-- --}}
{{-- </html> --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Traffic Monitoring Dashboard</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.store("dashboard", {
                packets: [],
                async fetchPackets() {
                    const response = await fetch("/api/packets");
                    this.packets = await response.json();
                },
            });
        });
    </script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <header class="bg-gray-800 text-white p-4 text-center">
        <h1 class="text-2xl font-bold">Network Traffic Monitoring Dashboard</h1>
    </header>

    <div class="container mx-auto py-6">
        <!-- Grid Layout: 2 Kolom -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column: Stats Panel, Traffic Chart, and Alerts -->
            <div>
                <!-- Stats Panel -->
                <div class="grid grid-cols-4 gap-4 mb-6" x-data="{ stats: {} }" x-init="fetch('/api/stats')
                    .then(response => response.json())
                    .then(data => stats = data)">
                    <div class="bg-white p-4 shadow rounded text-center">
                        <h2 class="text-lg font-semibold">Total Packets</h2>
                        <p x-text="stats.totalPackets || 0" class="text-xl font-bold text-gray-800"></p>
                    </div>
                    <div class="bg-white p-4 shadow rounded text-center">
                        <h2 class="text-lg font-semibold">Analyzed Traffic</h2>
                        <p x-text="stats.analyzedTraffic || 0" class="text-xl font-bold text-gray-800"></p>
                    </div>
                    <div class="bg-white p-4 shadow rounded text-center">
                        <h2 class="text-lg font-semibold">Alerts</h2>
                        <p x-text="stats.alerts || 0" class="text-xl font-bold text-red-600"></p>
                    </div>
                    <div class="bg-white p-4 shadow rounded text-center">
                        <h2 class="text-lg font-semibold">Normal Traffic</h2>
                        <p x-text="stats.normalTraffic || 0" class="text-xl font-bold text-green-600"></p>
                    </div>
                </div>

                <!-- Traffic Chart -->
                <div class="bg-white p-6 shadow rounded mb-6">
                    <h2 class="text-lg font-semibold mb-4">Network Traffic Over Time</h2>
                    <canvas id="traffic-chart" width="400" height="200"></canvas>
                </div>

                <!-- Alerts Section -->
                <div class="bg-yellow-200 text-yellow-900 font-bold p-4 mb-6 text-center rounded"
                    x-data="{ alertMessage: 'No issues detected', predictions: [] }" x-init="fetch('/api/ai-predictions')
                        .then(response => response.json())
                        .then(data => {
                            predictions = data;
                            if (predictions.some(prediction => prediction.prediction === 1)) {
                                alertMessage = 'Warning! Anomalies detected in network traffic.';
                            }
                        })">
                    <p x-text="alertMessage"></p>
                </div>
            </div>

            <!-- Right Column: Captured Packets Table -->
            <div class="bg-white p-6 shadow rounded">
                <h2 class="text-lg font-semibold mb-4">Captured Packets</h2>
                <table class="min-w-full bg-white border border-gray-200 rounded">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-2 px-4 border">Source IP</th>
                            <th class="py-2 px-4 border">Destination IP</th>
                            <th class="py-2 px-4 border">Packet Size</th>
                            <th class="py-2 px-4 border">Protocol</th>
                            <th class="py-2 px-4 border">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody x-data="$store.dashboard" x-init="fetchPackets">
                        <template x-for="packet in packets" :key="packet.id">
                            <tr class="text-center border-t hover:bg-gray-100">
                                <td class="py-2 px-4" x-text="packet.source_ip"></td>
                                <td class="py-2 px-4" x-text="packet.destination_ip"></td>
                                <td class="py-2 px-4" x-text="packet.packet_size"></td>
                                <td class="py-2 px-4" x-text="packet.protocol"></td>
                                <td class="py-2 px-4" x-text="packet.timestamp"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            // Ambil data dari API
            const response = await fetch('/api/stats');
            const stats = await response.json();

            // Ekstrak trafficOverTime dari respons API
            const trafficData = stats.trafficOverTime || [];

            // Data untuk chart
            const chartData = {
                labels: trafficData.map((item) => item.timestamp), // Waktu
                datasets: [{
                    label: "Traffic Over Time",
                    data: trafficData.map((item) => item.totalPackets), // Total Packets
                    borderColor: "rgba(75, 192, 192, 1)",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    fill: true,
                }, ],
            };

            // Opsi konfigurasi chart
            const options = {
                responsive: true,
                aspectRatio: 3,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: "top",
                    },
                },
                scales: {
                    x: {
                        type: "category",
                        title: {
                            display: true,
                            text: "Timestamp",
                        },
                        ticks: {
                            callback: function(value, index, ticks) {
                                // Format waktu jika diperlukan
                                return this.getLabelForValue(value).substring(11,
                                    16); // Hanya tampilkan jam dan menit
                            },
                            color: "#333",
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: "Total Packets",
                        },
                        ticks: {
                            color: "#333",
                        },
                    },
                },
            };

            // Inisialisasi chart
            const ctx = document.getElementById("traffic-chart").getContext("2d");
            new Chart(ctx, {
                type: "line",
                data: chartData,
                options: options,
            });
        });
    </script>
</body>

</html>
