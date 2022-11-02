<?php

namespace App\Helper;

use App\Models\CaptainVerificationFile;
use App\Models\Domain;
use App\Models\GeneralSetting;
use App\Models\Media;
use App\Models\Product;
use App\Models\Statistics;
use Auth;
use Browser;
use Exception;
use Gate;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Image;
use LaravelLocalization;
use Stevebauman\Location\Facades\Location;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Str;
use Symfony\Component\HttpFoundation\Response;
use function Clue\StreamFilter\register;

class Helper
{
    public static function setFileName($file): string
    {
        return time() . '-' . Str::random(100) . '.' . $file->extension();
    }

    public static function checkAccordionIsActive($url): bool
    {
        return url()->full() == $url;
    }

    public static function getModelMultiMediaUrls($model, $collectName): array
    {
        $links = [];
        if ($model->hasMedia($collectName)) {
            foreach ($model->getMedia($collectName) as $single_media) {
                $links[] = $single_media->getUrl();
            }
        }
        return $links;
    }

    public static function getFirstMediaUrl($model, $collectionName)
    {
        if ($model->hasMedia($collectionName)) {
            return $model->getFirstMediaUrl($collectionName);
        }
        $gs = GeneralSetting::query()->firstOrFail();
        return $gs->logo;
    }

    public static function notifications($className): array
    {
        $titles = [
            "" => "",
        ];
        return [
            "title" => $titles[$className],
        ];
    }

    public static function IsUpdateRequest(): bool
    {
        return in_array(strtolower(request()->getMethod()), ["put", "patch"]);
    }

    public static function abortPermission(string $permission)
    {
        if (request()->wantsJson()) {
            return response()->json([
                'success' => false,
                "data" => [],
                'message' => __("Permission Denied"),
            ], Response::HTTP_FORBIDDEN);
        }
        abort_unless(Gate::allows($permission), Response::HTTP_FORBIDDEN);
    }

    public static function setSlug($string, $separator = '-'): array|string|null
    {
        if (is_null($string)) {
            return "";
        }
        $string = trim($string);
        $string = str_replace([',', " ",
            '?', '"', '.', '/', '|', '\\',
            '~', '+', '>', '<', '؟', '#',
            '/', '\\', ' ', '\'', '"', '`',
            '!', '@', '$', '%', '^', '&', '*',
            '(', ')', '='], '-', $string);
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        return preg_replace("/[\s_]/", $separator, $string);
    }

    public static function getImageFromUrl($path, $width, $height)
    {
        $extension = File::extension($path);
        $saved_path = public_path('temp/' . Str::random(10) . '.' . $extension);
        try {
            $image = Image::make($path);
            $image->resize($width, $height);
            $image->save($saved_path);
            $image->destroy();
            return $saved_path;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public static function price($price, $with_currency = true): float|string
    {
        if ($with_currency) {
            return number_format($price, 2) . " " . __("SAR");
        }
        return floatval($price);
    }

    public static function months(): array
    {
        return [
            "jan" => [
                "title" => __("January"),
                "date" => Carbon::now()->firstOfYear()->format("Y-m-d H:i:s"),
            ],
            "feb" => [
                "title" => __("February"),
                "date" => Carbon::now()->firstOfYear()->addMonth()->format("Y-m-d H:i:s"),
            ],
            "mar" => [
                "title" => __("March"),
                "date" => Carbon::now()->firstOfYear()->addMonths(2)->format("Y-m-d H:i:s"),
            ],
            "apr" => [
                "title" => __("April"),
                "date" => Carbon::now()->firstOfYear()->addMonths(3)->format("Y-m-d H:i:s"),
            ],
            "may" => [
                "title" => __("May"),
                "date" => Carbon::now()->firstOfYear()->addMonths(4)->format("Y-m-d H:i:s"),
            ],
            "june" => [
                "title" => __("June"),
                "date" => Carbon::now()->firstOfYear()->addMonths(5)->format("Y-m-d H:i:s"),
            ],
            "july" => [
                "title" => __("July"),
                "date" => Carbon::now()->firstOfYear()->addMonths(6)->format("Y-m-d H:i:s"),
            ],
            "aug" => [
                "title" => __("August"),
                "date" => Carbon::now()->firstOfYear()->addMonths(7)->format("Y-m-d H:i:s"),
            ],
            "sept" => [
                "title" => __("September"),
                "date" => Carbon::now()->firstOfYear()->addMonths(8)->format("Y-m-d H:i:s"),
            ],
            "oct" => [
                "title" => __("October"),
                "date" => Carbon::now()->firstOfYear()->addMonths(9)->format("Y-m-d H:i:s"),
            ],
            "nov" => [
                "title" => __("November"),
                "date" => Carbon::now()->firstOfYear()->addMonths(10)->format("Y-m-d H:i:s"),
            ],
            "dec" => [
                "title" => __("December"),
                "date" => Carbon::now()->firstOfYear()->addMonths(11)->format("Y-m-d H:i:s"),
            ],
        ];
    }

    public static function formatDate($data, $format = "Y-m-d H:i:s"): string
    {
        return Carbon::parse($data)->format($format);
    }

    public static function setLang($value, $enableTranslation = false): array
    {
        $languages = config("laravellocalization.supportedLocales");
        $data = [];
        foreach ($languages as $locale => $lanValue) {
            if ($enableTranslation) {
                $data[$locale] = Helper::translate($locale, $value);
            } else {
                $data[$locale] = $value;
            }
        }
        return $data;
    }

    public static function imageRules($isUpdateAction = false): array
    {
        if ($isUpdateAction) {
            return [
                "nullable",
                "mimetypes:" . implode(",", Media::$IMAGES_MIMES_TYPES)
            ];
        }
        return [
            "required",
            "mimetypes:" . implode(",", Media::$IMAGES_MIMES_TYPES)
        ];
    }

    public static function translate($to, $word, $from = null): ?string
    {
        if (!is_null($word)) {
            $googleTranslate = new GoogleTranslate();
            if ($from == null) {
                $googleTranslate->setSource();
            } else {
                $googleTranslate->setSource($from);
            }
            $googleTranslate->setTarget($to);
            return $googleTranslate->translate($word);
        }
        return $word ?? "";
    }

    public static function getLocationDetailsFromGoogleMapApi($fromLat, $fromLng, $toLat, $toLng): array
    {
        $googleMapApi = config("services.google_map.api");
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?language=" . LaravelLocalization::getCurrentLocale() . "&destinations=$fromLat,$fromLng&origins=$toLat,$toLng&key=$googleMapApi";
        $response = Http::get($url);
        Log::info(json_encode($response));
        if ($response->status() == 200 && isset($response["rows"]) && $response["status"] == "OK") {
            $response = $response->json();

            if ($response["rows"][0]["elements"][0]["status"] == "ZERO_RESULTS") {
                return [
                    "distanceText" => 0,
                    "distanceValue" => 0,
                    "durationText" => 0,
                    "durationValue" => 0,
                ];
            }

            return [
                "distanceText" => $response["rows"][0]["elements"][0]["distance"]["text"],
                "distanceValue" => $response["rows"][0]["elements"][0]["distance"]["value"] / 1000,
                "durationText" => $response["rows"][0]["elements"][0]["duration"]["text"],
                "durationValue" => $response["rows"][0]["elements"][0]["duration"]["value"] / 60,
            ];
        } else {
            return [
                "distanceText" => 0,
                "distanceValue" => 0,
                "durationText" => 0,
                "durationValue" => 0,
            ];
        }
    }

    public static function getCaptainDeliveryTypes(): array
    {
        return Auth::user()
            ->captain
            ->verificationFiles()
            ->whereNotIn("id", [1, 2])
            ->where("status", 1)
            ->get()
            ->map(function (CaptainVerificationFile $captainVerificationFile) {
                return $captainVerificationFile->option->related_orders;
            })
            ->toArray();
    }
}
