<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QradarService
{
    public static function getOffenses($start = 0, $limit = 100, $minSeverity = 0)
    {
        $end = $start + $limit - 1;

        return Http::withHeaders([
            'SEC' => env('QRADAR_TOKEN'),
            'Accept' => 'application/json',
            'Range' => "items=$start-$end", 
        ])
        ->withoutVerifying()
        ->timeout(120)
        ->get(env('QRADAR_URL') . '/api/siem/offenses', [
            'fields' => 'id,description,categories,severity',
            'filter' => "severity >= $minSeverity"
        ])
        ->json();
    }
}
