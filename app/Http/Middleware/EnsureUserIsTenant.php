<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsTenant
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || !$user->company_id) {
            return response()->json(['message' => 'Unauthorized - No tenant found.'], 401);
        }
        //  Usage::where('company_id', $companyId)
        //         ->increment('api_calls_used');
        

        return $next($request);
    }
}
