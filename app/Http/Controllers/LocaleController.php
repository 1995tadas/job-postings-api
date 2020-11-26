<?php

namespace App\Http\Controllers;

use App\Services\LocaleService;

class LocaleController extends Controller
{
    public function Change(): \Illuminate\Http\RedirectResponse
    {
        $localeService = new LocaleService();
        $localeService->changeLocale();
        return redirect()->back();
    }
}
