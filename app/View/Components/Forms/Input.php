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

    public function __construct($type = 'text', $name, $placeholder = '')
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.forms.input');
    }
}