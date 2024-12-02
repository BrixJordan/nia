<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $placeholder;

    public function __construct($name, $type = 'text', $placeholder = '')
{
    $this->name = $name;
    $this->type = $type;
    $this->placeholder = $placeholder;
}


    public function render()
    {
        return view('components.forms.input');
    }
}