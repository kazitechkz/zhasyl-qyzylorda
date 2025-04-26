<?php

namespace App\Http\Middleware;

use App\Models\GeoPosition;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BeforeSessionFlush
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 2) {
                $geo = GeoPosition::where('user_id', Auth::id())->first();
                if ($geo) {
                    $plusHour = Carbon::parse($geo->updated_at)->addHours(2);
                    if ($plusHour < Carbon::now()) {
                        $geo->delete();
                    }
                }
            }
        }
        return $next($request);
    }
}
