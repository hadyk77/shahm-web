<?php

namespace App\View\Components\Fields;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\Component;
use Illuminate\View\View;

class TextField extends Component
{
    public string $index;
    public string $locale;
    public string $title;
    public string $name;
    public $model;
    public bool $required;

    /**
     * Create a new component instance.
     *
     * @param string $index
     * @param string $locale
     * @param string $title
     * @param string $name
     * @param null $model
     * @param bool $required
     */
    public function __construct(string $index, string $locale, string $title, string $name, $model = null, $required = false)
    {
        $this->index = $index;
        $this->locale = $locale;
        $this->title = $title;
        $this->model = $model;
        $this->name = $name;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.fields.text-field');
    }
}
