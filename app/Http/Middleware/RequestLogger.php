<?php

namespace App\Http\Middleware;

use App\Models\DonHang;
use Carbon\Carbon;
use Closure;

class RequestLogger
{
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->routeIs('analytics.dashboard')) {
            return $response;
        }

        $requestTime = Carbon::createFromTimestamp($_SERVER['REQUEST_TIME']);
        $request = DonHang::create([
            'url' => $request->getPathInfo(),
            'method' => $request->method(),
            'response_time' => time() - $requestTime->timestamp,
            'day' => date('l', $requestTime->timestamp),
            'hour' => $requestTime->hour,
        ]);

        return $response;
    }
}
