@php
    $icons = ['agricole' => 'fa-seedling', 'commercial' => 'fa-handshake', 'logistique' => 'fa-truck', 'partenariat' => 'fa-people-group', 'terrain' => 'fa-camera'];
@endphp
<a href="{{ route('projects.show', $project->slug) }}" class="project-card reveal">
    <div class="project-thumb">
        @if($project->cover_image)
            <img src="{{ asset($project->cover_image) }}" alt="{{ $project->title }}" loading="lazy">
        @else
            <div class="thumb-fallback"><i class="fa-solid {{ $icons[$project->category] ?? 'fa-seedling' }}"></i></div>
        @endif
        @if($project->is_demo)<span class="badge-demo">Contenu de démonstration</span>@endif
    </div>
    <div class="p-4">
        <span class="chip">{{ $project->category_label }}</span>
        <h3 class="h5 mt-2">{{ $project->title }}</h3>
        <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($project->summary, 120) }}</p>
    </div>
</a>
