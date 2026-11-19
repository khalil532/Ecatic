<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Service;
use App\Support\Slug;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index', [
            'items' => Service::with('activity')->orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.services.form', [
            'item'       => new Service(['icon' => 'fa-check', 'is_published' => true, 'sort_order' => 0]),
            'activities' => Activity::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->payload($request);
        $data['slug'] = Slug::unique(Service::class, $data['title']);
        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service créé.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', [
            'item'       => $service,
            'activities' => Activity::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $service->update($this->payload($request));

        return redirect()->route('admin.services.index')->with('success', 'Service mis à jour.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return back()->with('success', 'Service supprimé.');
    }

    private function payload(Request $request): array
    {
        $v = $request->validate([
            'activity_id' => ['nullable', 'integer', 'exists:activities,id'],
            'title'       => ['required', 'string', 'max:150'],
            'icon'        => ['required', 'regex:/^fa-[a-z0-9-]+$/'],
            'summary'     => ['required', 'string', 'max:300'],
            'description' => ['nullable', 'string', 'max:10000'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:65000'],
        ]);

        return [
            'activity_id'  => $v['activity_id'] ?? null,
            'title'        => $v['title'],
            'icon'         => $v['icon'],
            'summary'      => $v['summary'],
            'description'  => $v['description'] ?? null,
            'sort_order'   => (int) ($v['sort_order'] ?? 0),
            'is_published' => $request->boolean('is_published'),
        ];
    }
}
