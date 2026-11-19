<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    public function up(): void
    {
        $email = 'Contact.ecatic@gmail.com';
        $row = DB::table('site_settings')->where('key', 'contact_email')->first();

        if (! $row) {
            DB::table('site_settings')->insert([
                'key' => 'contact_email', 'value' => $email, 'group' => 'contact',
                'label' => 'E-mail de contact', 'type' => 'email',
                'created_at' => now(), 'updated_at' => now(),
            ]);
        } elseif (blank($row->value)) {
            DB::table('site_settings')->where('key', 'contact_email')
                ->update(['value' => $email, 'label' => 'E-mail de contact', 'updated_at' => now()]);
        }

        Cache::forget('site_settings');
    }

    public function down(): void
    {
        // volontairement vide : on ne supprime pas une coordonnée de contact
    }
};
