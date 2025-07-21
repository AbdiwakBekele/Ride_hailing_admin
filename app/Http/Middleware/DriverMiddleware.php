<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check authentication
        if (!auth()->check()) {
            return response()->json([
                'ok' => false,
                'message' => 'Authentication required'
            ], 401);
        }

        $user = auth()->user();

        // Verify user type
        if ($user->user_type !== 'driver') {
            return response()->json([
                'ok' => false,
                'message' => 'Driver access only'
            ], 403);
        }

        // Check driver profile existence
        if (!$user->driver) {
            return response()->json([
                'ok' => false,
                'message' => 'Driver profile not found'
            ], 404);
        }

        return $next($request);
    }
}
