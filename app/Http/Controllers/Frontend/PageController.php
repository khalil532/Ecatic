<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.home', [
            'activities' => Activity::published()->get(),
            'projects'   => Project::published()->take(3)->get(),
        ]);
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function activities()
    {
        return view('frontend.activities', [
            'activities' => Activity::published()->get(),
        ]);
    }

    public function services()
    {
        return view('frontend.services', [
            'activities' => Activity::published()->with(['services' => fn ($q) => $q->published()])->get(),
            'orphans'    => Service::published()->whereNull('activity_id')->get(),
            'allServices' => Service::published()->get(),
        ]);
    }

    public function projects(Request $request)
    {
        $category = $request->query('categorie');
        $query = Project::published();

        if ($category && array_key_exists($category, Project::CATEGORIES)) {
            $query->where('category', $category);
        } else {
            $category = null;
        }

        return view('frontend.projects', [
            'projects' => $query->paginate(9)->withQueryString(),
            'category' => $category,
        ]);
    }

    public function projectShow(string $slug)
    {
        $project = Project::published()->where('slug', $slug)->with('images')->firstOrFail();

        return view('frontend.project-show', compact('project'));
    }
}
