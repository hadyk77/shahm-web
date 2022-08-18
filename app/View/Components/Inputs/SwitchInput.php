<?php

namespace App\View\Components\Inputs;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SwitchInput extends Component
{
    public ?string $title;
    public ?string $name;
    public ?bool $value;

    /**
     * Create a new component instance.
     *
     * @param string|null $title
     * @param string|null $name
     * @param bool $value
     */
    public function __construct(string $title = null, string $name = null, bool $value = false)
    {
        //
        $this->title = $title;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.inputs.switch-input');
    }
}
