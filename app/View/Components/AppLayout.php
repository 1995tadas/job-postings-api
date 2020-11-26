<?php

namespace App\View\Components;

use App\Services\LocaleService;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $language;

    public function __construct()
    {
        $localeService = new LocaleService();
        $language = $localeService->getLocale();
        $this->language = $language;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
