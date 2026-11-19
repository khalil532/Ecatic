<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Support\ImageStore;
use App\Support\Slug;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'items' => Project::withCount('images')->latest()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.projects.form', [
            'item' => new Project(['category' => 'agricole', 'is_published' => true, 'is_demo' => false]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->payload($request);
        $data['slug'] = Slug::unique(Project::class, $data['title']);
        if ($request->hasFile('cover')) {
            $data['cover_image'] = ImageStore::save($request->file('cover'), 'projects');
        }
        $project = Project::create($data);
        $this->saveGallery($request, $project);

        return redirect()->route('admin.projects.edit', $project)->with('success', 'Projet créé.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', ['item' => $project->load('images')]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->payload($request);
        if ($request->hasFile('cover')) {
            ImageStore::delete($project->cover_image);
            $data['cover_image'] = ImageStore::save($request->file('cover'), 'projects');
        }
        $project->update($data);
        $this->saveGallery($request, $project);

        return redirect()->route('admin.projects.edit', $project)->with('success', 'Projet mis à jour.');
    }

    public function destroy(Project $project)
    {
        foreach ($project->images as $img) {
            ImageStore::delete($img->path);
        }
        ImageStore::delete($project->cover_image);
        $project->delete(); // project_images supprimées en cascade

        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé.');
    }

    public function destroyImage(ProjectImage $image)
    {
        ImageStore::delete($image->path);
        $image->delete();

        return back()->with('success', 'Image supprimée.');
    }

    private function payload(Request $request): array
    {
        $v = $request->validate([
            'title'        => ['required', 'string', 'max:180'],
            'category'     => ['required', Rule::in(array_keys(Project::CATEGORIES))],
            'summary'      => ['required', 'string', 'max:600'],
            'description'  => ['nullable', 'string', 'max:10000'],
            'location'     => ['nullable', 'string', 'max:150'],
            'project_date' => ['nullable', 'date'],
            'cover'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'images.*'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        return [
            'title'        => $v['title'],
            'category'     => $v['category'],
            'summary'      => $v['summary'],
            'description'  => $v['description'] ?? null,
            'location'     => $v['location'] ?? null,
            'project_date' => $v['project_date'] ?? null,
            'is_demo'      => $request->boolean('is_demo'),
            'is_published' => $request->boolean('is_published'),
        ];
    }

    private function saveGallery(Request $request, Project $project): void
    {
        foreach ((array) $request->file('images', []) as $i => $file) {
            if ($file && $file->isValid()) {
                $project->images()->create([
                    'path'       => ImageStore::save($file, 'projects'),
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
