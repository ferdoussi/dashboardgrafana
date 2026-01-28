<?php

namespace App\Services;

class QradarNormalizer
{
    public static function normalize(array $offenses)
    {
        return collect($offenses)->map(function ($o) {
            return [
                'id' => $o['id'],
                'description' => $o['description'] ?? '',
                'categories' => $o['categories'] ?? [],
                'severity' => $o['severity'] ?? 0,
            ];
        })->toArray();
    }
}
