@extends('layouts.admin')
@section('title', $item->exists ? 'Modifier le projet' : 'Nouveau projet')
@section('heading', $item->exists ? 'Modifier : ' . $item->title : 'Nouveau projet')
@section('actions')<a href="{{ route('admin.projects.index') }}" class="btn btn-light">← Retour</a>@endsection

@section('content')
<form class="card-ec p-4 mb-4" method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.projects.update', $item) : route('admin.projects.store') }}">
    @csrf
    @if($item->exists) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-md-8"><label class="form-label fw-semibold">Titre *</label><input name="title" class="form-control" required maxlength="180" value="{{ old('title', $item->title) }}"></div>
        <div class="col-md-4"><label class="form-label fw-semibold">Catégorie *</label>
            <select name="category" class="form-select" required>
                @foreach(\App\Models\Project::CATEGORIES as $k => $label)<option value="{{ $k }}" @selected(old('category', $item->category) === $k)>{{ $label }}</option>@endforeach
            </select></div>
        <div class="col-md-6"><label class="form-label fw-semibold">Lieu</label><input name="location" class="form-control" maxlength="150" value="{{ old('location', $item->location) }}"></div>
        <div class="col-md-6"><label class="form-label fw-semibold">Date</label><input type="date" name="project_date" class="form-control" value="{{ old('project_date', optional($item->project_date)->format('Y-m-d')) }}"></div>
        <div class="col-12"><label class="form-label fw-semibold">Résumé * (600 car. max)</label><textarea name="summary" rows="2" class="form-control" required maxlength="600">{{ old('summary', $item->summary) }}</textarea></div>
        <div class="col-12"><label class="form-label fw-semibold">Description détaillée</label><textarea name="description" rows="6" class="form-control">{{ old('description', $item->description) }}</textarea></div>
        <div class="col-md-6"><label class="form-label fw-semibold">Image de couverture (JPG, PNG, WebP – 4 Mo max)</label><input type="file" name="cover" accept="image/jpeg,image/png,image/webp" class="form-control">@if($item->cover_image)<img src="{{ asset($item->cover_image) }}" class="thumb mt-2" alt="">@endif</div>
        <div class="col-md-6"><label class="form-label fw-semibold">Ajouter des images à la galerie</label><input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp" class="form-control"><div class="form-text">Plusieurs fichiers possibles. L'enregistrement redimensionne et optimise les images.</div></div>
        <div class="col-md-6"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_published" value="1" id="pub" @checked(old('is_published', $item->is_published))><label class="form-check-label" for="pub">Publié sur le site</label></div></div>
        <div class="col-md-6"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_demo" value="1" id="demo" @checked(old('is_demo', $item->is_demo))><label class="form-check-label" for="demo">Contenu de démonstration (affiche un badge « démo »)</label></div></div>
        <div class="col-12"><button class="btn btn-ec px-4">Enregistrer</button></div>
    </div>
</form>

@if($item->exists && $item->images->count())
    <div class="card-ec p-4">
        <h2 class="h6 fw-bold mb-3">Galerie ({{ $item->images->count() }} images)</h2>
        <div class="row g-3">
            @foreach($item->images as $img)
                <div class="col-6 col-md-3 col-xl-2">
                    <img src="{{ asset($img->path) }}" class="img-fluid rounded-3 mb-2" alt="">
                    <form method="POST" action="{{ route('admin.project-images.destroy', $img) }}" onsubmit="return confirm('Supprimer cette image ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger w-100">Supprimer</button></form>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection
