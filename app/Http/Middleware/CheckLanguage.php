<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $language = $request->route('lang');
        if (!in_array($language, config('app.available_locales'))) {
            return response()->json(['error' => $language . ': language not allowed'], 400);
        }

        return $next($request);
    }
}
