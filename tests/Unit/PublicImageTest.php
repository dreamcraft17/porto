<?php

namespace Tests\Unit;

use App\Support\PublicImage;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicImageTest extends TestCase
{
    public function test_uploaded_file_uses_media_route_when_storage_symlink_missing(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('projects/cover.jpg', 'jpeg-bytes');

        $link = public_path('storage');
        $hadLink = is_link($link);
        $previousTarget = $hadLink ? readlink($link) : null;

        if ($hadLink) {
            unlink($link);
        }

        try {
            $url = PublicImage::url('projects/cover.jpg');
            $this->assertSame('/media/projects/cover.jpg', $url);
        } finally {
            if ($hadLink && $previousTarget !== null) {
                symlink($previousTarget, $link);
            }
        }
    }

    public function test_uploaded_file_uses_storage_asset_when_symlink_present(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('projects/cover.jpg', 'jpeg-bytes');

        $link = public_path('storage');
        $hadLink = is_link($link);
        $previousTarget = $hadLink ? readlink($link) : null;

        if ($hadLink) {
            unlink($link);
        }

        symlink(storage_path('app/public'), $link);

        try {
            $url = PublicImage::url('projects/cover.jpg');
            $this->assertSame(asset('storage/projects/cover.jpg'), $url);
        } finally {
            if (is_link($link) || file_exists($link)) {
                unlink($link);
            }
            if ($hadLink && $previousTarget !== null) {
                symlink($previousTarget, $link);
            }
        }
    }

    public function test_legacy_filename_checks_public_images_projects(): void
    {
        Storage::fake('public');

        $dir = public_path('images/projects');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file = $dir.'/legacy.jpg';
        file_put_contents($file, 'x');

        try {
            $this->assertSame(asset('images/projects/legacy.jpg'), PublicImage::url('legacy.jpg'));
        } finally {
            @unlink($file);
        }
    }
}
