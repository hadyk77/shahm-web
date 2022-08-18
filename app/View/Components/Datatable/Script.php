<?php

namespace App\View\Components\Datatable;

use Illuminate\View\Component;

class Script extends Component
{
    public $route;
    public $columns;
    public $filtersColumns;

    /**
     * @var bool
     */
    public ?bool $enableId;

    /**
     * Create a new component instance.
     *
     * @param $route
     * @param $columns
     * @param bool $enableId
     */
    public function __construct($route, $columns, ?bool $enableId = true, ?array $filtersColumns = [])
    {
        $this->route = $route;
        $this->columns = $columns;
        $this->enableId = $enableId;
        $this->filtersColumns = $filtersColumns;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.datatable.script');
    }
}
