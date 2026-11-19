<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Support\ImageStore;
use App\Support\Slug;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return view('admin.activities.index', ['items' => Activity::orderBy('sort_order')->get()]);
    }

    public function create()
    {
        return view('admin.activities.form', [
            'item' => new Activity(['icon' => 'fa-seedling', 'is_published' => true, 'sort_order' => 0]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->payload($request);
        $data['slug'] = Slug::unique(Activity::class, $data['title']);
        if ($request->hasFile('image')) {
            $data['image'] = ImageStore::save($request->file('image'), 'activities');
        }
        Activity::create($data);

        return redirect()->route('admin.activities.index')->with('success', 'Activité créée.');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.form', ['item' => $activity]);
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $this->payload($request);
        if ($request->hasFile('image')) {
            ImageStore::delete($activity->image);
            $data['image'] = ImageStore::save($request->file('image'), 'activities');
        }
        $activity->update($data);

        return redirect()->route('admin.activities.index')->with('success', 'Activité mise à jour.');
    }

    public function destroy(Activity $activity)
    {
        ImageStore::delete($activity->image);
        $activity->delete(); // les services liés sont conservés (activity_id → null)

        return back()->with('success', 'Activité supprimée.');
    }

    private function payload(Request $request): array
    {
        $v = $request->validate([
            'title'       => ['required', 'string', 'max:150'],
            'icon'        => ['required', 'regex:/^fa-[a-z0-9-]+$/'],
            'summary'     => ['required', 'string', 'max:300'],
            'description' => ['required', 'string', 'max:10000'],
            'highlights'  => ['nullable', 'string', 'max:3000'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:65000'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        return [
            'title'        => $v['title'],
            'icon'         => $v['icon'],
            'summary'      => $v['summary'],
            'description'  => $v['description'],
            'highlights'   => array_values(array_filter(array_map('trim', preg_split('/\R/', $v['highlights'] ?? '')))),
            'sort_order'   => (int) ($v['sort_order'] ?? 0),
            'is_published' => $request->boolean('is_published'),
        ];
    }
}
