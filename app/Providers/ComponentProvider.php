<?php

namespace App\Providers;

use App\View\Components\BreadCrumb\BreadCrumbComponent;
use App\View\Components\Button\AddButton;
use App\View\Components\Buttons\BackButtonComponent;
use App\View\Components\Buttons\SaveButton;
use App\View\Components\Buttons\UpdateButton;
use App\View\Components\Card\CardBody;
use App\View\Components\Card\CardContent;
use App\View\Components\Card\CardFooter;
use App\View\Components\Card\CardHeader;
use App\View\Components\Card\CardTitle;
use App\View\Components\Card\CardToolbar;
use App\View\Components\Datatable\HtmlStructure;
use App\View\Components\Datatable\Script;
use App\View\Components\Datatable\SearchInput;
use App\View\Components\Field\InputWithUrl;
use App\View\Components\Fields\FileField;
use App\View\Components\Fields\InputField;
use App\View\Components\Fields\SummernoteField;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ComponentProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        Blade::component(CardContent::class, "card-content");
        Blade::component(CardBody::class, "card-body");
        Blade::component(CardHeader::class, "card-header");
        Blade::component(CardTitle::class, "card-title");
        Blade::component(CardToolbar::class, "card-toolbar");
        Blade::component(CardFooter::class, "card-footer");

        Blade::component(HtmlStructure::class, "datatable-html");
        Blade::component(Script::class, "datatable-script");
        Blade::component(SearchInput::class, "datatable-search-input");

        Blade::component(BackButtonComponent::class, 'back-btn');
        Blade::component(SaveButton::class, 'save-btn');
        Blade::component(UpdateButton::class, 'update-btn');
        Blade::component(AddButton::class, 'add-btn');

        Blade::component(InputField::class, 'input-field');
        Blade::component(FileField::class, 'file-field');
        Blade::component(InputWithUrl::class, "input-with-url-field");
        Blade::component(SummernoteField::class, 'summernote-field');

        Blade::component(BreadCrumbComponent::class, "bread-crumb");
    }
}
