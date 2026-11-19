@extends('layouts.admin')
@section('title', $item->exists ? 'Modifier l\'activité' : 'Nouvelle activité')
@section('heading', $item->exists ? 'Modifier : ' . $item->title : 'Nouvelle activité')
@section('actions')<a href="{{ route('admin.activities.index') }}" class="btn btn-light">← Retour</a>@endsection

@section('content')
<form class="card-ec p-4" method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.activities.update', $item) : route('admin.activities.store') }}">
    @csrf
    @if($item->exists) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-md-8"><label class="form-label fw-semibold">Titre *</label><input name="title" class="form-control" required maxlength="150" value="{{ old('title', $item->title) }}"></div>
        <div class="col-md-4"><label class="form-label fw-semibold">Ordre d'affichage</label><input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order) }}"></div>
        <div class="col-md-6"><label class="form-label fw-semibold">Icône Font Awesome *</label><input name="icon" class="form-control" required value="{{ old('icon', $item->icon) }}" list="icons" placeholder="fa-seedling"><datalist id="icons"><option value="fa-seedling"><option value="fa-globe-africa"><option value="fa-truck-fast"><option value="fa-wheat-awn"><option value="fa-ship"><option value="fa-warehouse"><option value="fa-handshake"></datalist><div class="form-text">Nom d'une icône gratuite de <a href="https://fontawesome.com/search?o=r&m=free&s=solid" target="_blank" rel="noopener">Font Awesome</a> (ex. fa-seedling).</div></div>
        <div class="col-md-6"><label class="form-label fw-semibold">Image (JPG, PNG, WebP – 4 Mo max)</label><input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="form-control">@if($item->image)<img src="{{ asset($item->image) }}" class="thumb mt-2" alt="">@endif</div>
        <div class="col-12"><label class="form-label fw-semibold">Résumé court * (300 car. max)</label><input name="summary" class="form-control" required maxlength="300" value="{{ old('summary', $item->summary) }}"></div>
        <div class="col-12"><label class="form-label fw-semibold">Description *</label><textarea name="description" rows="5" class="form-control" required>{{ old('description', $item->description) }}</textarea></div>
        <div class="col-12"><label class="form-label fw-semibold">Points clés (un par ligne)</label><textarea name="highlights" rows="5" class="form-control">{{ old('highlights', implode("\n", $item->highlights ?? [])) }}</textarea></div>
        <div class="col-12"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_published" value="1" id="pub" @checked(old('is_published', $item->is_published))><label class="form-check-label" for="pub">Publiée sur le site</label></div></div>
        <div class="col-12"><button class="btn btn-ec px-4">Enregistrer</button></div>
    </div>
</form>
@endsection
