<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Entreprise
            ['company_name', 'ECATIC', 'company', "Nom de l'entreprise", 'text'],
            ['company_slogan', "Nous développons l'agrobusiness sénégalais et connectons l'Afrique au monde.", 'company', 'Slogan', 'textarea'],
            ['company_intro', "ECATIC est une entreprise sénégalaise basée à Sébikotane, dans la région de Dakar. Nous développons l'agrobusiness au Sénégal et connectons l'Afrique au monde.", 'company', 'Présentation courte', 'textarea'],
            ['company_vision', "Faire de l'agriculture sénégalaise un moteur de développement économique, capable de nourrir l'Afrique et de conquérir les marchés internationaux.", 'company', 'Vision', 'textarea'],
            ['company_mission', "Valoriser le potentiel agricole sénégalais, développer les échanges commerciaux internationaux et faciliter le transport et la distribution des produits agroalimentaires.", 'company', 'Mission', 'textarea'],
            // Page À propos
            ['about_story', "ECATIC est une entreprise sénégalaise basée à Sébikotane, dans la région de Dakar. Nous développons l'agrobusiness au Sénégal et connectons l'Afrique au monde. Nous travaillons avec les producteurs, les coopératives, les entreprises et les partenaires internationaux.", 'about', 'Présentation / histoire (page À propos)', 'textarea'],
            ['about_identity', "Une entreprise sénégalaise active dans l'agrobusiness, l'import-export, le transport et la logistique, tournée vers les marchés locaux et internationaux.", 'about', 'Notre identité', 'textarea'],
            ['about_values', "Engagement envers les producteurs\nIntégrité et transparence\nQualité et fiabilité\nOuverture à l'international\nDéveloppement durable du territoire", 'about', 'Nos valeurs (une par ligne)', 'textarea'],
            ['about_ambitions', "Valoriser le potentiel agricole sénégalais, développer les échanges commerciaux internationaux et faciliter le transport et la distribution des produits agroalimentaires.", 'about', 'Nos ambitions', 'textarea'],
            ['about_commitment', "Nous travaillons main dans la main avec les producteurs, les coopératives, les entreprises et les partenaires internationaux, dans une logique de collaboration durable.", 'about', 'Notre engagement', 'textarea'],
            // Contact
            ['contact_address', 'Sébikotane, Dakar, Sénégal', 'contact', 'Adresse', 'text'],
            ['contact_phone', '+221 77 228 48 71', 'contact', 'Téléphone', 'text'],
            ['contact_whatsapp', '221772284871', 'contact', 'WhatsApp (format international, sans +)', 'text'],
            ['contact_email', 'Contact.ecatic@gmail.com', 'contact', 'E-mail de contact', 'email'],
            ['google_maps_embed', '', 'contact', 'URL d\'intégration Google Maps (iframe src)', 'url'],
            // Réseaux sociaux
            ['social_facebook', '', 'social', 'Facebook', 'url'],
            ['social_linkedin', '', 'social', 'LinkedIn', 'url'],
            ['social_instagram', '', 'social', 'Instagram', 'url'],
            ['social_x', '', 'social', 'X (Twitter)', 'url'],
            // SEO
            ['seo_title', 'ECATIC Sénégal | Agrobusiness, Import-Export, Transport et Logistique', 'seo', 'Titre SEO par défaut', 'text'],
            ['seo_description', "ECATIC, entreprise sénégalaise basée à Sébikotane (Dakar) : agrobusiness, import-export, commerce international, transport et logistique.", 'seo', 'Méta-description par défaut', 'textarea'],
        ];

        foreach ($settings as [$key, $value, $group, $label, $type]) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                compact('value', 'group', 'label', 'type')
            );
        }
    }
}
