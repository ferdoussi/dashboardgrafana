<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QradarService
{
public static function getOffenses()
{
    return Http::withHeaders([
        'SEC' => env('QRADAR_TOKEN'),
        'Accept' => 'application/json',
        'Range' => 'items=0-500', 
    ])
    ->withoutVerifying()
    ->get(env('QRADAR_URL') . '/api/siem/offenses', [
        'fields' => 'id,description,categories,severity',
        'filter' => 'severity >= 0' 
    ])
    ->json();
}


}
