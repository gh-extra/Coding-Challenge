<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckChainOwner
{
    public function handle(Request $request, Closure $next)
    {
        $chain = $request->route('chain');

        if ($chain && $chain->user_id !== Auth::id()) {
            abort(403, 'You do not own this chain.');
        }

        return $next($request);
    }
}
