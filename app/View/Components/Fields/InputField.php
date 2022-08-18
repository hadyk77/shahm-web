<?php

namespace App\View\Components\Fields;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class InputField extends Component
{
    public ?string $col;
    public ?string $name;
    public ?string $title;
    public ?string $required;
    public ?string $translatedInput;
    public ?string $type;
    public ?string $hint;
    public ?string $value;
    public ?Model $model;

    /**
     * Create a new component instance.
     *
     * @param string|null $col
     * @param string|null $name
     * @param string|null $title
     * @param string|null $hint
     * @param string|null $required
     * @param string|null $translatedInput
     * @param string|null $type
     * @param Model|null $model
     */
    public function __construct(
        ?string $col = null,
        ?string $name = null,
        ?string $title = null,
        ?string $value = null,
        ?string $hint = null,
        ?string $required = null,
        ?string $translatedInput = null,
        ?string $type = null,
        ?Model  $model = null
    )
    {
        //
        $this->col = $col;
        $this->name = $name;
        $this->title = $title;
        $this->value = $value;
        $this->hint = $hint;
        $this->required = $required;
        $this->translatedInput = $translatedInput;
        $this->type = $type;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.fields.input-field');
    }
}
