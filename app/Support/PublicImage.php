<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

final class PublicImage
{
    public static function normalize(string $path): string
    {
        $path = ltrim($path, '/');
        $path = preg_replace('#^(?:storage|public)/#', '', $path) ?? $path;

        return ltrim($path, '/');
    }

    public static function url(?string $path): ?string
    {
        if (! filled($path)) {
            return null;
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        $normalized = self::normalize($path);

        return Storage::disk('public')->exists($normalized)
            ? '/media/'.self::encodePath($normalized)
            : null;
    }

    public static function encodePath(string $path): string
    {
        return implode('/', array_map('rawurlencode', explode('/', $path)));
    }
}
