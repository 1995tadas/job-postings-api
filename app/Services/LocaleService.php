<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class LocaleService
{
    public function changeLocale(): void
    {
        $possibleLocales = config('app.available_locales');

        if (App::isLocale($possibleLocales[0])) {
            $newLocale = $possibleLocales[1];
        } else {
            $newLocale = $possibleLocales[0];
        }

        App::setLocale($newLocale);
        session(['locale' => $newLocale]);
    }

    public function getLocale(): string
    {
        return App::getLocale();
    }

    public function setLocale($locale): void
    {
        App::setLocale($locale);
    }
}
