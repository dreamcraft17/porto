<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
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

        $normalized = self::normalize($path);

        if ($normalized === '') {
            return null;
        }

        foreach (self::publicAssetCandidates($normalized) as $candidate) {
            if (file_exists(public_path($candidate))) {
                return asset(self::encodePath($candidate));
            }
        }

        if (! Storage::disk('public')->exists($normalized)) {
            return null;
        }

        if (self::publicStorageSymlinkAvailable($normalized)) {
            return asset('storage/'.self::encodePath($normalized));
        }

        if (Route::has('media.show')) {
            return route('media.show', ['path' => $normalized], false);
        }

        return '/media/'.self::encodePath($normalized);
    }

    /**
     * @return list<string>
     */
    private static function publicAssetCandidates(string $normalized): array
    {
        if (str_contains($normalized, '/')) {
            return [$normalized];
        }

        return [
            'images/projects/'.$normalized,
            'images/'.$normalized,
            $normalized,
        ];
    }

    private static function publicStorageSymlinkAvailable(string $normalized): bool
    {
        $link = public_path('storage');

        if (is_link($link)) {
            return true;
        }

        return file_exists(public_path('storage/'.$normalized));
    }

    public static function encodePath(string $path): string
    {
        return implode('/', array_map('rawurlencode', explode('/', $path)));
    }
}
