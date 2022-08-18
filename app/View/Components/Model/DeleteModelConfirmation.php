<?php

namespace App\View\Components\Model;

use Illuminate\View\Component;

class DeleteModelConfirmation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.model.delete-model-confirmation');
    }
}
