<?php

namespace App\Support;

use Illuminate\Support\Str;

class Slug
{
    /** Génère un slug unique pour le modèle donné. */
    public static function unique(string $modelClass, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'element';
        $slug = $base;
        $i = 2;

        while ($modelClass::where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
