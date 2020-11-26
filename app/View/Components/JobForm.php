<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JobForm extends Component
{
    public $action;
    public $postingsTranslations;

    /**
     * Create a new component instance.
     *
     * @param $action
     * @param array $postingsTranslations
     */
    public function __construct($action, array $postingsTranslations = [])
    {
        $this->action = $action;
        $this->postingsTranslations = $postingsTranslations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.job-form');
    }
}
