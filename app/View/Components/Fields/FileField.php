<?php

namespace App\View\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class FileField extends Component
{
    public ?string $col;
    public ?string $title;
    public ?string $subTitle;
    public bool $required;
    public bool $multi;
    public ?string $name;
    public ?string $collection;
    public ?Model $model;

    public function __construct(
        ?string $col = null,
        ?string $name = null,
        ?string $title = null,
        ?string $subTitle = null,
        bool    $required = false,
        bool    $multi = false,
        ?string $collection = null,
        ?Model  $model = null
    )
    {
        //
        $this->title = $title;
        $this->subTitle = $subTitle;
        $this->required = $required;
        $this->name = $name;
        $this->multi = $multi;
        $this->collection = $collection;
        $this->model = $model;
        $this->col = $col;
    }

    public function render()
    {
        return view('components.fields.file-field');
    }
}
