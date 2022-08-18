<?php

namespace App\View\Components\Fields;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SummernoteField extends Component
{
    public ?string $col;
    public string $title;
    public string $name;
    public ?string $hint;
    public ?string $translatedInput;
    public $model;
    public bool $required;


    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $name
     * @param string|null $hint
     * @param null $model
     * @param bool $required
     * @param string|null $col
     * @param string|null $translatedInput
     */
    public function __construct(string $title, string $name, ?string $hint = null, $model = null, bool $required = false, ?string $col = null, ?string $translatedInput = null)
    {
        $this->title = $title;
        $this->model = $model;
        $this->col = $col;
        $this->hint = $hint;
        $this->name = $name;
        $this->translatedInput = $translatedInput;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.fields.summernote-field');
    }
}
