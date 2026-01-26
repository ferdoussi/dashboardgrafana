<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class GrafanaProxyController extends Controller
{
   public function proxy(Request $request, $any)
{
    $grafana = rtrim(config('services.grafana.url'), '/');
    $username = Auth::user()->email ?? 'anonymous';
    $url = $grafana . '/' . $any;

    $response = Http::withOptions(['verify' => false])
        ->withHeaders([
            'X-WEBAUTH-USER' => $username
        ])
        ->get($url, $request->query());

    return response($response->body(), $response->status())
        ->header('Content-Type', $response->header('Content-Type', 'text/html'))
        ->header('X-Frame-Options', 'ALLOWALL'); // pour que l'iframe fonctionne
}

}
