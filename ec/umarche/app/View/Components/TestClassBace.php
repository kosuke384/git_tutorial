<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestClassBace extends Component
{
    public $classBaceMessage;
    public $defaultMessage;
    /**
     * Create a new component instance.
     */
    public function __construct($classBaceMessage,$defaultMessage="初期値です")
    {
        $this -> classBaceMessage = $classBaceMessage;
        $this -> defaultMessage = $defaultMessage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tests.test-class-bace-component');
    }
}
