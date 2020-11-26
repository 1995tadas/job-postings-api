<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formTextarea extends Component
{
    public $id;
    public $value;
    public $name;

    /**
     * Create a new component instance.
     *
     * @param $id
     * @param $value
     * @param $name
     */
    public function __construct($id, $value, $name)
    {
        $this->id = $id;
        $this->value = $value;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form-textarea');
    }
}
