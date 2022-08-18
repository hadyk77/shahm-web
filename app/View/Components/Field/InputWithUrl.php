<?php

namespace App\View\Components\Field;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class InputWithUrl extends Component
{

    public ?string $col;
    public ?string $name;
    public ?string $title;
    public ?string $required;
    public ?Model $model;
    public ?string $url;

    /**
     * Create a new component instance.
     *
     * @param string|null $col
     * @param string|null $name
     * @param string|null $url
     * @param string|null $title
     * @param string|null $required
     * @param Model|null $model
     */
    public function __construct(
        ?string $col = null,
        ?string $name = null,
        ?string $url = null,
        ?string $title = null,
        ?string $required = null,
        ?Model  $model = null
    )
    {
        //
        $this->col = $col;
        $this->name = $name;
        $this->url = $url;
        $this->title = $title;
        $this->required = $required;
        $this->model = $model;
    }


    public function render()
    {
        return view('components.fields.input-with-url');
    }
}
