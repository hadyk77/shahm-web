<?php

namespace App\Http\Controllers\Admin\Translation;

use App\Http\Controllers\Controller;
use App\Models\AccountUpgradeOption;
use App\Models\Banner;
use App\Models\ContactType;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\Governorate;
use App\Models\IntroImages;
use App\Models\Nationality;
use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceUsage;
use App\Models\VerificationOption;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TranslationController extends Controller
{
    public function index()
    {
        return view("admin.pages.translation.index")->with([
            "translatable" => self::translatable(),
        ]);
    }

    public function show(Request $request)
    {
        $this->validate($request, [
            "model" => "required",
            "id" => "required",
            "columns" => "required|array",
        ]);
        $model = app($request->model)->findOrFail($request->id);
        $columns = $request->columns;
        return view("admin.pages.translation.show")->with([
            "model" => $model,
            "columns" => $columns,
        ])->render();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            "model" => "required|string",
            "model_id" => "required"
        ]);

        $columns = (new Collection(self::translatable()))->values()->where("model", $request->model)->first();


        if (is_null($columns)) {

            $columns = collect((new Collection(self::translatable()))->values()->pluck("relations"))
                ->values()
                ->where("0.model", $request->model)
                ->firstOrFail()[0];

        }

        $model = app($request->model)->findOrFail($request->model_id);

        $attributes = [];
        foreach ($columns["columns"] as $key => $value) {
            $attributes[$key] = $request->all()[$key];
        }
        $model->update($attributes);
        return $this::sendSuccessResponse([
            "title" => $attributes[array_key_first($columns["columns"])]["ar"] ?? ""
        ], __("Updated Successfully"));
    }

    public static function translatable(): array
    {
        return [
            __("Services") => [
                "model" => Service::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                ],
                "relations" => [
                    [
                        "relationName" => "serviceUsages",
                        "model" => ServiceUsage::class,
                        "translatableColumn" => "title",
                        "columns" => [
                            "title" => [
                                "type" => "text",
                                "rules" => "required"
                            ],
                            "description" => [
                                "type" => "textarea",
                                "rules" => "required"
                            ]
                        ],
                    ]
                ]
            ],
            __('General Setting') => [
                "model" => GeneralSetting::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "rules" => "required"
                    ]
                ],
            ],
            __('Pages') => [
                "model" => Page::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "rules" => "required"
                    ]
                ],
            ],
            __("Banners") => [
                "model" => Banner::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                ]
            ],
            __("Account Upgrade Options") => [
                "model" => AccountUpgradeOption::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                ]
            ],
            __("Verification Files") => [
                "model" => VerificationOption::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "rules" => "required"
                    ],
                ]
            ],
            __("Country") => [
                "model" => Country::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                ]
            ],
            __("Governorate") => [
                "model" => Governorate::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                ]
            ],
            __("Nationality") => [
                "model" => Nationality::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                ]
            ],
            __("Intro Image") => [
                "model" => IntroImages::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ],
                    "description" => [
                        "type" => "textarea",
                        "rules" => "required"
                    ],
                ]
            ],
            __("Contact Type") => [
                "model" => ContactType::class,
                "translatableColumn" => "title",
                "columns" => [
                    "title" => [
                        "type" => "text",
                        "rules" => "required"
                    ]
                ]
            ],
        ];
    }
}
