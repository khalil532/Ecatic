<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $urls = [
            [route('home'), '1.0'],
            [route('about'), '0.8'],
            [route('activities'), '0.9'],
            [route('services'), '0.9'],
            [route('projects'), '0.7'],
            [route('contact'), '0.8'],
        ];

        foreach (Project::published()->get(['slug', 'updated_at']) as $p) {
            $urls[] = [route('projects.show', $p->slug), '0.5'];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
             . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as [$loc, $prio]) {
            $xml .= '  <url><loc>' . e($loc) . '</loc><priority>' . $prio . '</priority></url>' . "\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
