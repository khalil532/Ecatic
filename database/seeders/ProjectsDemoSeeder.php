<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

/**
 * Contenus de DÉMONSTRATION uniquement (is_demo = true) :
 * à remplacer par les vraies réalisations depuis /admin.
 */
class ProjectsDemoSeeder extends Seeder
{
    public function run(): void
    {
        $demo = [
            ['agricole', 'Exemple – Projet agricole', 'exemple-projet-agricole', "Contenu de démonstration. Remplacez-le par une réalisation agricole réelle depuis l'espace administrateur."],
            ['commercial', 'Exemple – Opération commerciale', 'exemple-operation-commerciale', "Contenu de démonstration. Remplacez-le par une opération commerciale réelle."],
            ['logistique', 'Exemple – Opération logistique', 'exemple-operation-logistique', "Contenu de démonstration. Remplacez-le par une opération logistique réelle."],
            ['partenariat', 'Exemple – Partenariat', 'exemple-partenariat', "Contenu de démonstration. Remplacez-le par un partenariat réel."],
        ];

        foreach ($demo as [$cat, $title, $slug, $summary]) {
            Project::updateOrCreate(['slug' => $slug], [
                'title' => $title,
                'category' => $cat,
                'summary' => $summary,
                'is_demo' => true,
                'is_published' => true,
            ]);
        }
    }
}
