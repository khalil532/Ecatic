<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Agrobusiness',
                'slug' => 'agrobusiness',
                'image' => 'images/activities/agrobusiness.jpg',
                'icon' => 'fa-seedling',
                'summary' => "Production, transformation et valorisation des produits agricoles locaux, en collaboration avec les producteurs.",
                'description' => "ECATIC s'engage dans le développement des filières agricoles sénégalaises, de la production à la valorisation des produits locaux, en travaillant avec les producteurs et les coopératives.",
                'highlights' => ['Production agricole', 'Transformation agricole', 'Valorisation des produits locaux', 'Collaboration avec les producteurs', 'Développement des filières agricoles'],
                'sort_order' => 1,
            ],
            [
                'title' => 'Import & Export',
                'slug' => 'import-export',
                'image' => 'images/activities/import-export.jpg',
                'icon' => 'fa-globe-africa',
                'summary' => "Importation de produits agroalimentaires et exportation de produits agricoles sénégalais vers les marchés internationaux.",
                'description' => "Nous facilitons le commerce international et la mise en relation avec des partenaires commerciaux, afin de développer les échanges entre l'Afrique et le reste du monde.",
                'highlights' => ['Importation de produits agroalimentaires', 'Exportation de produits agricoles sénégalais', 'Commerce international', 'Mise en relation avec les partenaires commerciaux', "Développement des échanges entre l'Afrique et le reste du monde"],
                'sort_order' => 2,
            ],
            [
                'title' => 'Transport et logistique',
                'slug' => 'transport-logistique',
                'image' => 'images/activities/transport-logistique.jpg',
                'icon' => 'fa-truck-fast',
                'summary' => "Transport de marchandises, logistique commerciale et acheminement des produits.",
                'description' => "ECATIC accompagne les opérations commerciales par des solutions de transport et de logistique adaptées à la distribution des produits agroalimentaires.",
                'highlights' => ['Transport de marchandises', 'Logistique commerciale', 'Acheminement des produits', 'Accompagnement des opérations commerciales'],
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            Activity::updateOrCreate(['slug' => $item['slug']], $item + ['is_published' => true]);
        }
    }
}
