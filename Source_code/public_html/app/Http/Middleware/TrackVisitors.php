<?php

namespace App\Http\Middleware;

use App\Models\VisitorCount;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $today = now()->startOfDay();

        // Check if a record with the same IP address for today exists
        $existingVisitor = VisitorCount::where('ip_address', $ip)
            ->where('created_at', '>=', $today)
            ->exists();

        // If no record exists, create a new one
        if (!$existingVisitor && $ip) {
            VisitorCount::create([
                'ip_address' => $ip
            ]);
        }
        
        return $next($request);
    }
}
