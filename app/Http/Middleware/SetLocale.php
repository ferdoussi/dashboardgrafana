<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // كنقرأو اللغة من السيسيون، وإلا مالقيناهاش كنخدمو باللي في config/app.php
        $locale = session('locale', config('app.locale'));
        
        App::setLocale($locale);

        return $next($request);
    }
}