<?php

namespace App\Enums;

enum UserEnum
{
    public static function gender(): array
    {
        return [
            "male" => __("Male"),
            "female" => __("Female"),
        ];
    }
}
