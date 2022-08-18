<?php

namespace App\View\Components\BreadCrumb;

use Illuminate\View\Component;

class BreadCrumbComponent extends Component
{
    public $routes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($routes)
    {
        //
        $this->routes = $routes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bread-crumb.bread-crumb-component');
    }
}
