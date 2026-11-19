<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $map = Activity::pluck('id', 'slug');

        $items = [
            ['agrobusiness', 'Approvisionnement en produits agricoles', 'approvisionnement-produits-agricoles', 'fa-wheat-awn', "Mise en relation avec des producteurs et coopératives pour l'approvisionnement en produits agricoles sénégalais."],
            ['agrobusiness', 'Valorisation et transformation', 'valorisation-transformation', 'fa-industry', "Accompagnement de la transformation et de la valorisation des produits locaux."],
            ['import-export', 'Exportation de produits sénégalais', 'exportation-produits-senegalais', 'fa-ship', "Exportation de produits agricoles sénégalais vers des partenaires internationaux."],
            ['import-export', 'Importation de produits agroalimentaires', 'importation-agroalimentaire', 'fa-boxes-stacked', "Importation de produits agroalimentaires pour les entreprises et distributeurs."],
            ['import-export', 'Mise en relation commerciale', 'mise-en-relation-commerciale', 'fa-handshake', "Connexion entre fournisseurs, acheteurs et partenaires commerciaux."],
            ['transport-logistique', 'Transport de marchandises', 'transport-marchandises', 'fa-truck', "Transport de marchandises et acheminement des produits."],
            ['transport-logistique', 'Logistique commerciale', 'logistique-commerciale', 'fa-warehouse', "Accompagnement logistique des opérations commerciales."],
        ];

        foreach ($items as $i => [$act, $title, $slug, $icon, $summary]) {
            Service::updateOrCreate(['slug' => $slug], [
                'activity_id' => $map[$act] ?? null,
                'title' => $title,
                'icon' => $icon,
                'summary' => $summary,
                'sort_order' => $i + 1,
                'is_published' => true,
            ]);
        }
    }
}
