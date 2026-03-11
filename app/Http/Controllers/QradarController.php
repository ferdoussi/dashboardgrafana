<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class QradarController extends Controller
{
    private function getHttpClient() {
        return Http::withHeaders([
            'SEC' => env('QRADAR_TOKEN'),
            'Accept' => 'application/json'
        ])->when(env('QRADAR_IGNORE_SSL'), fn($client) => $client->withoutVerifying());
    }

    public function liveEvents()
    {
        $cacheKey = 'qradar_final_data';
        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }
        return response()->json(['message' => 'Data is being updated...'], 202);
    }

    public function refreshData()
    {
        set_time_limit(600); 

        try {
            $baseUrl = env('QRADAR_URL');
            $http = $this->getHttpClient();
            
            
            $query = "SELECT sourceip AS src_ip, 
                             GEO::LOOKUP(sourceip, 'latitude') AS src_lat, 
                             GEO::LOOKUP(sourceip, 'longitude') AS src_lon, 
                             33.5731 AS dst_lat, -7.5898 AS dst_lon, 
                             COUNT(*) AS hits 
                      FROM events 
                      WHERE src_lat IS NOT NULL 
                      GROUP BY src_ip, src_lat, src_lon 
                      LIMIT 300 LAST 24 HOURS";

            $create = $http->asForm()->post("{$baseUrl}/api/ariel/searches", [
                'query_expression' => $query
            ]);

            if (!$create->successful()) {
                return response()->json(['status' => 'error', 'details' => $create->json()], 500);
            }

            $searchId = $create->json('search_id');

            // 2. Polling
            $status = 'WAIT';
            $tries = 0;
            while (!in_array($status, ['COMPLETED', 'ERROR', 'CANCELED']) && $tries < 150) {
                sleep(3);
                $check = $http->get("{$baseUrl}/api/ariel/searches/{$searchId}");
                $status = $check->json('status');
                $tries++;
            }

            
            if ($status === 'COMPLETED') {
                $results = $http->get("{$baseUrl}/api/ariel/searches/{$searchId}/results");
                $rawEvents = $results->json('events') ?? [];
                
                $cleanedEvents = [];

                foreach ($rawEvents as $event) {
                    
                    $latData = json_decode($event['src_lat'], true);
                    $lonData = json_decode($event['src_lon'], true);

                    $latitude = $latData['location']['latitude'] ?? null;
                    $longitude = $lonData['location']['longitude'] ?? null;

                    
                    if ($latitude !== null && $longitude !== null) {
                        $cleanedEvents[] = [
                            'src_ip'  => $event['src_ip'],
                            'src_lat' => (float) $latitude,
                            'src_lon' => (float) $longitude,
                            'dst_lat' => (float) $event['dst_lat'],
                            'dst_lon' => (float) $event['dst_lon'],
                            'hits'    => (int) $event['hits']
                        ];
                    }
                }

                
                Cache::put('qradar_final_data', $cleanedEvents, 600);

                return response()->json([
                    'status' => 'success',
                    'count' => count($cleanedEvents),
                    'data' => $cleanedEvents
                ]);
            }

            return response()->json(['status' => 'failed', 'qradar_status' => $status], 202);

        } catch (\Exception $e) {
            return response()->json(['status' => 'exception', 'message' => $e->getMessage()], 500);
        }
    }
}