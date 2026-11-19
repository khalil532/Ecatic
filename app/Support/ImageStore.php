<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Enregistre les images téléversées dans public/uploads/<dossier>,
 * les redimensionne (max 1600 px) et les convertit en WebP si GD le permet.
 */
class ImageStore
{
    public static function save(UploadedFile $file, string $dir): string
    {
        $dir = trim($dir, '/');
        $target = public_path("uploads/{$dir}");
        if (! is_dir($target)) {
            mkdir($target, 0755, true);
        }

        $base = Str::random(24);

        if (function_exists('imagecreatefromstring') && function_exists('imagewebp')) {
            $img = @imagecreatefromstring((string) file_get_contents($file->getRealPath()));
            if ($img !== false) {
                $w = imagesx($img);
                $h = imagesy($img);
                $max = 1600;
                if ($w > $max) {
                    $img = imagescale($img, $max, (int) round($h * $max / $w));
                }
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
                $name = "{$base}.webp";
                imagewebp($img, "{$target}/{$name}", 82);
                imagedestroy($img);

                return "uploads/{$dir}/{$name}";
            }
        }

        $ext = $file->guessExtension() ?: 'jpg';
        $name = "{$base}.{$ext}";
        $file->move($target, $name);

        return "uploads/{$dir}/{$name}";
    }

    public static function delete(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'uploads/') || str_contains($path, '..')) {
            return;
        }
        $full = public_path($path);
        if (is_file($full)) {
            @unlink($full);
        }
    }
}
