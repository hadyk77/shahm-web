<?php

namespace App\Support;

use Str;

class DataTableActions
{

    private bool $showBtn = false;
    private string $showRoute;

    private ?string $html = "";

    private bool $deleteBtn = false;
    private bool $deleteActionInModel = false;
    private bool $showDeleteBtn = true;
    private string $deleteRoute;

    private bool $editBtn = false;
    private string $editRoute;

    private bool $printBtn = false;
    private string $printRoute;

    private string $switcherModel;
    private int $switcherModelId;
    private ?string $switcher_column_name = "status";
    private bool $status = false;

    public function edit(string $route): DataTableActions
    {
        $this->editBtn = true;
        $this->editRoute = $route;
        return $this;
    }

    public function print(string $route): DataTableActions
    {
        $this->printBtn = true;
        $this->printRoute = $route;
        return $this;
    }

    public function show(string $route): DataTableActions
    {
        $this->showBtn = true;
        $this->showRoute = $route;
        return $this;
    }

    public function button($html = ""): DataTableActions
    {
        $this->html = $html;
        return $this;
    }

    public function delete(string $route, bool $actionInModel = true, $showBtn = true): DataTableActions
    {
        $this->deleteBtn = true;
        $this->deleteActionInModel = $actionInModel;
        $this->showDeleteBtn = $showBtn;
        $this->deleteRoute = $route;

        return $this;
    }

    public function make(): string
    {
        $html = '<div class="d-flex justify-content-center flex-shrink-0">';
        if ($this->showBtn) {
            $html .= '<a href="' . $this->showRoute . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd">

                                <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="currentColor"/>
                                <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="currentColor" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
                            </g>
                        </svg>
                    </span>
            </a>';
        }
        if ($this->printBtn) {
            $html .= '<a href="' . $this->printRoute . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" target="_blank">
                         <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="currentColor">
                                    <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="currentColor"/>
                                    <rect fill="currentColor" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>
                    </a>';
        }
        if ($this->editBtn) {
            $html .= '<a href="' . $this->editRoute . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                    </svg>
                </span>
            </a>';
        }
        $html .= $this->html;
        if ($this->deleteBtn && $this->showDeleteBtn) {
            if ($this->deleteActionInModel) {
                $html .= '<a data-bs-toggle="modal" data-bs-target="#delete" href="javascript:;" data-href="' . $this->deleteRoute . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">';
            } else {
                $html .= '<a href="' . $this->deleteRoute . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">';
            }
            $html .= '<span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                    </svg>
                </span>
            </a>';
        }
        $html .= "</div>";
        return $html;
    }

    public function model(object $model): DataTableActions
    {
        $this->switcherModel = get_class($model);
        return $this;
    }

    public function column(string $column_name = "status"): DataTableActions
    {
        $this->switcher_column_name = $column_name;
        return $this;
    }

    public function modelId($model_id): DataTableActions
    {
        $this->switcherModelId = $model_id;
        return $this;
    }

    public function checkStatus($status): DataTableActions
    {
        $this->status = $status;
        return $this;
    }

    public function switcher(): string
    {
        $html = '<label class="form-check cursor-pointer form-switch form-check-custom form-check-solid justify-content-center">';
        $html .= '<input class="form-check-input cursor-pointer w-50px switcher" type="checkbox" data-modelId="' . $this->switcherModelId . '" data-model="' . $this->switcherModel . '" data-columnName="' . $this->switcher_column_name . '" ' . ($this->status == 1 ? 'checked="checked"' : '') . '>';
        $html .= '</label>';
        return $html;
    }

    public static function image($imageUrl, $width = 50): string
    {
        $html = "<div class='symbol symbol-" . $width . "px me-5'>";
        $html .= "<img src='$imageUrl' alt='image' />";
        $html .= "</div>";
        return $html;
    }

    public function color($colorCode): string
    {
        return "<div  style='width: 20px;height:20px;margin: auto;border-radius: 50%;background-color: " . $colorCode . "'></div>";
    }

    public static function bgColor($bgColor, $text): string
    {
        return "<div class='badge badge-light-" . Str::replace("bg-", "", $bgColor) . "'>" . $text . "</div>";
    }

    public static function link($link, $text): string
    {
        return "<a href='" . $link . "' >" . $text . "</div>";
    }

    public static function checkBox($id): string
    {
        return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input input_checkbox" type="checkbox" value="' . $id . '"/>
                </div>';
    }
}
