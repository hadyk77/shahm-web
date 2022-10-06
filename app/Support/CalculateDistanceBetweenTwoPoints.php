<?php

namespace App\Support;

class CalculateDistanceBetweenTwoPoints
{
    public static function calculateDistanceBetweenTwoPoints(string $latitudeOne = '', string $longitudeOne = '', string $latitudeTwo = '', string $longitudeTwo = '', string $distanceUnit = '', bool $round = false, string $decimalPoints = ''): float
    {
        if (empty($decimalPoints)) {
            $decimalPoints = '3';
        }
        if (empty($distanceUnit)) {
            $distanceUnit = 'KM';
        }

        $pointDifference = $longitudeOne - $longitudeTwo;
        $toSin = (sin(deg2rad($latitudeOne)) * sin(deg2rad($latitudeTwo))) + (cos(deg2rad($latitudeOne)) * cos(deg2rad($latitudeTwo)) * cos(deg2rad($pointDifference)));
        $toAcos = acos($toSin);
        $toRad2Deg = rad2deg($toAcos);

        $toMiles = $toRad2Deg * 60 * 1.1515;
        $toKilometers = $toMiles * 1.609344;
        $toNauticalMiles = $toMiles * 0.8684;
        $toMeters = $toKilometers * 1000;
        $toFeets = $toMiles * 5280;
        $toYards = $toFeets / 3;

        return match (strtoupper($distanceUnit)) {
            'ML' => ($round ? round($toMiles) : round($toMiles, $decimalPoints)),
            'KM' => ($round ? round($toKilometers) : round($toKilometers, $decimalPoints)),
            'MT' => ($round ? round($toMeters) : round($toMeters, $decimalPoints)),
            'FT' => ($round ? round($toFeets) : round($toFeets, $decimalPoints)),
            'YD' => ($round ? round($toYards) : round($toYards, $decimalPoints)),
            'NM' => ($round ? round($toNauticalMiles) : round($toNauticalMiles, $decimalPoints)),
            default => 0,
        };
    }

}
