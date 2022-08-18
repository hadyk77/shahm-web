<?php

namespace App\View\Components\Fields;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SelectField extends Component
{
    public ?string $col;
    public ?string $name;
    public ?string $title;
    public ?string $required;
    public ?Model $model;
    public ?Collection $selectBoxData;
    public ?string $value;
    public ?string $valueData;
    public ?string $secondName;

    /**
     * Create a new component instance.
     *
     * @param string|null $col
     * @param string|null $name
     * @param string|null $title
     * @param string|null $required
     * @param Model|null $model
     * @param Collection|null $selectBoxData
     * @param string|null $value
     * @param string|null $valueData
     * @param string|null $secondName
     */
    public function __construct(
        ?string     $col = null,
        ?string     $name = null,
        ?string     $title = null,
        ?string     $required = null,
        ?Model      $model = null,
        ?Collection $selectBoxData = null,
        ?string     $value = null,
        ?string     $valueData = null,
        ?string     $secondName = null
    )
    {
        //
        $this->col = $col;
        $this->name = $name;
        $this->title = $title;
        $this->required = $required;
        $this->model = $model;
        $this->selectBoxData = $selectBoxData;
        $this->value = $value;
        $this->valueData = $valueData;
        $this->secondName = $secondName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.fields.select-field');
    }
}
