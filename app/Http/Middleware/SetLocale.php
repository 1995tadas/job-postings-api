<?php

namespace App\Http\Middleware;

use App\Services\LocaleService;
use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale');
        if ($locale) {
            $localeService = new LocaleService();
            $localeService->setLocale($locale);
        }

        return $next($request);
    }
}
