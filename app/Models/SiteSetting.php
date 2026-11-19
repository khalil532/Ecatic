<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Throwable;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'label', 'type'];

    /** Tous les réglages sous forme [clé => valeur] (mis en cache). */
    public static function allCached(): array
    {
        try {
            return Cache::rememberForever('site_settings', fn () => static::pluck('value', 'key')->all());
        } catch (Throwable $e) {
            return []; // base non migrée / indisponible : le site reste affichable
        }
    }

    public static function get(string $key, $default = null)
    {
        return static::allCached()[$key] ?? $default;
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings'));
        static::deleted(fn () => Cache::forget('site_settings'));
    }
}
