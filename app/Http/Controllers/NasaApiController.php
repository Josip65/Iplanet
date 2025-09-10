<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class NasaApiController extends Controller
{
    protected $nasaApiKey;
    protected $eventIcons = [
        'Wildfires' => '🔥',
        'Severe Storms' => '⛈️',
        'Volcanoes' => '🌋',
        'Sea Lake Ice' => '🧊',
        'Earthquakes' => '🌍',
        'Drought' => '🏜️',
        'floods' => '🌊',
        'landslides' => '⛰️',
        'snow' => '❄️',
        'tempExtremes' => '🌡️',
        'manmade' => '🏗️',
        'default' => '📍'
    ];

    public function __construct()
    {
        $this->nasaApiKey = env('NASA_API_KEY');
    }

   
    public function getEvents()
    {
        try {
            $apiKey = config('services.nasa.key');
            $response = Http::get('https://eonet.gsfc.nasa.gov/api/v2.1/events', [
                'days' => 7,
                'status' => 'open',
                'api_key' => $apiKey,
                //'limit' => 100 // Uncomment to limit number of events
            ]);

            if ($response->successful()) {
                $events = [];
                $data = $response->json();
                
                if (isset($data['events']) && is_array($data['events'])) {
                    foreach ($data['events'] as $event) {
                        $category = $event['categories'][0]['title'] ?? 'default';
                        $coordinates = $event['geometries'][0]['coordinates'] ?? [0, 0];
                        $date = $event['geometries'][0]['date'] ?? now()->toIso8601String();
                        
                        $events[] = [
                            'id' => $event['id'],
                            'title' => $event['title'],
                            'description' => $event['description'] ?? 'Nema opisa',
                            'category' => $category,
                            'icon' => $this->eventIcons[$category] ?? $this->eventIcons['default'],
                            'lat' => (float)$coordinates[1],
                            'lng' => (float)$coordinates[0],
                            'date' => Carbon::parse($date)->format('d.m.Y. H:i'),
                            'sources' => $event['sources'] ?? [],
                            'status' => $event['status'] ?? 'unknown',
                            'geometry' => $event['geometries'] ?? []
                        ];
                    }
                }
                
                return response()->json($events);
            }
            
            return response()->json([
                'error' => 'Failed to fetch events data',
                'status' => $response->status()
            ], 500);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
    
}
