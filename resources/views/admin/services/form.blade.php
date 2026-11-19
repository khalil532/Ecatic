@extends('layouts.admin')
@section('title', $item->exists ? 'Modifier le service' : 'Nouveau service')
@section('heading', $item->exists ? 'Modifier : ' . $item->title : 'Nouveau service')
@section('actions')<a href="{{ route('admin.services.index') }}" class="btn btn-light">← Retour</a>@endsection

@section('content')
<form class="card-ec p-4" method="POST" action="{{ $item->exists ? route('admin.services.update', $item) : route('admin.services.store') }}">
    @csrf
    @if($item->exists) @method('PUT') @endif
    <div class="row g-3">
        <div class="col-md-8"><label class="form-label fw-semibold">Titre *</label><input name="title" class="form-control" required maxlength="150" value="{{ old('title', $item->title) }}"></div>
        <div class="col-md-4"><label class="form-label fw-semibold">Ordre d'affichage</label><input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order) }}"></div>
        <div class="col-md-6"><label class="form-label fw-semibold">Activité associée</label>
            <select name="activity_id" class="form-select"><option value="">— Aucune —</option>
                @foreach($activities as $a)<option value="{{ $a->id }}" @selected((string) old('activity_id', $item->activity_id) === (string) $a->id)>{{ $a->title }}</option>@endforeach
            </select></div>
        <div class="col-md-6"><label class="form-label fw-semibold">Icône Font Awesome *</label><input name="icon" class="form-control" required value="{{ old('icon', $item->icon) }}" placeholder="fa-truck"></div>
        <div class="col-12"><label class="form-label fw-semibold">Résumé court * (300 car. max)</label><input name="summary" class="form-control" required maxlength="300" value="{{ old('summary', $item->summary) }}"></div>
        <div class="col-12"><label class="form-label fw-semibold">Description détaillée</label><textarea name="description" rows="5" class="form-control">{{ old('description', $item->description) }}</textarea></div>
        <div class="col-12"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_published" value="1" id="pub" @checked(old('is_published', $item->is_published))><label class="form-check-label" for="pub">Publié sur le site</label></div></div>
        <div class="col-12"><button class="btn btn-ec px-4">Enregistrer</button></div>
    </div>
</form>
@endsection
