<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formInput extends Component
{
    public $name;
    public $value;
    public $id;
    public $required;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $value
     * @param string $id
     * @param bool $required
     */
    public function __construct($name, $value, $id = '', $required = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form-input');
    }
}
