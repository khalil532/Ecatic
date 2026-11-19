<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Réglages du site + images de marque, disponibles dans toutes les vues
        View::composer(['layouts.*', 'frontend.*', 'admin.*', 'errors.*'], function ($view) {
            $view->with('site', SiteSetting::allCached());
            $view->with('brand', [
                'logo'    => $this->brandImage('logo'),
                'banner1' => $this->brandImage('banner-1'),
                'banner2' => $this->brandImage('banner-2'),
            ]);
        });
    }

    private function brandImage(string $name): ?string
    {
        foreach (['png', 'jpg', 'jpeg', 'webp', 'svg'] as $ext) {
            if (is_file(public_path("images/{$name}.{$ext}"))) {
                return asset("images/{$name}.{$ext}");
            }
        }

        return null;
    }
}
