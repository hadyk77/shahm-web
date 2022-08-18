<?php

namespace App\View\Components\Buttons;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BackButtonComponent extends Component
{
    public string $route;

    /**
     * Create a new component instance.
     *
     * @param string $route
     */
    public function __construct(string $route)
    {
        //
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.buttons.back-button-component');
    }
}
