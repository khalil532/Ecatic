@extends('layouts.admin')
@section('title', 'Paramètres du site')
@section('heading', 'Paramètres du site')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')
    @foreach($groups as $key => $title)
        @if(isset($settings[$key]))
            <div class="card-ec p-4 mb-4">
                <h2 class="h6 fw-bold text-uppercase mb-3" style="color:#087443">{{ $title }}</h2>
                <div class="row g-3">
                    @foreach($settings[$key] as $s)
                        <div class="{{ $s->type === 'textarea' ? 'col-12' : 'col-md-6' }}">
                            <label class="form-label fw-semibold" for="s_{{ $s->key }}">{{ $s->label }}</label>
                            @if($s->type === 'textarea')
                                <textarea id="s_{{ $s->key }}" name="settings[{{ $s->key }}]" rows="3" class="form-control @error('settings.' . $s->key) is-invalid @enderror">{{ old('settings.' . $s->key, $s->value) }}</textarea>
                            @else
                                <input id="s_{{ $s->key }}" type="{{ in_array($s->type, ['url', 'email']) ? $s->type : 'text' }}" name="settings[{{ $s->key }}]" value="{{ old('settings.' . $s->key, $s->value) }}" class="form-control @error('settings.' . $s->key) is-invalid @enderror">
                            @endif
                            @error('settings.' . $s->key)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            @if($s->key === 'google_maps_embed')<div class="form-text">Google Maps → Partager → Intégrer une carte → copiez uniquement l'adresse figurant dans <code>src="…"</code>.</div>@endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
    <button class="btn btn-ec btn-lg px-5">Enregistrer les paramètres</button>
</form>
@endsection
