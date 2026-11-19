<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{
    public const GROUPS = [
        'company' => "Informations de l'entreprise",
        'contact' => 'Coordonnées de contact',
        'social'  => 'Réseaux sociaux',
        'seo'     => 'Référencement (SEO)',
        'about'   => 'Textes de la page « À propos »',
    ];

    public function edit()
    {
        return view('admin.settings', [
            'settings' => SiteSetting::orderBy('id')->get()->groupBy('group'),
            'groups'   => self::GROUPS,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate(['settings' => ['required', 'array'], 'settings.*' => ['nullable', 'string', 'max:5000']]);

        $errors = [];
        $all = SiteSetting::all();

        foreach ($all as $setting) {
            if (! array_key_exists($setting->key, $request->input('settings', []))) {
                continue;
            }
            $value = trim((string) $request->input("settings.{$setting->key}"));

            if ($value !== '') {
                if ($setting->type === 'url' && ! preg_match('#^https?://#i', $value)) {
                    $errors["settings.{$setting->key}"] = "« {$setting->label} » doit commencer par http:// ou https://";
                    continue;
                }
                if ($setting->key === 'google_maps_embed' && ! str_starts_with($value, 'https://www.google.com/maps')) {
                    $errors["settings.{$setting->key}"] = "L'URL Google Maps doit commencer par https://www.google.com/maps";
                    continue;
                }
                if ($setting->type === 'email' && ! filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors["settings.{$setting->key}"] = "« {$setting->label} » n'est pas une adresse e-mail valide.";
                    continue;
                }
            }

            $setting->value = $value;
            $setting->save();
        }

        if ($errors) {
            throw ValidationException::withMessages($errors);
        }

        return back()->with('success', 'Paramètres enregistrés.');
    }
}
