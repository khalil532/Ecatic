<div class="col-md-6 col-lg-4 reveal">
    <div class="service-card h-100">
        <div class="icon-circle sm"><i class="fa-solid {{ $s->icon }}"></i></div>
        <h3 class="h5">{{ $s->title }}</h3>
        <p class="text-muted small">{{ $s->summary }}</p>
        @if($s->description)<p class="text-muted small">{!! nl2br(e($s->description)) !!}</p>@endif
        <div class="d-flex flex-wrap gap-2 mt-auto pt-2">
            <a class="btn btn-outline-ec btn-sm" href="{{ route('contact', ['type' => 'information', 'sujet' => 'Information – ' . $s->title]) }}">Demander des infos</a>
            <button type="button" class="btn btn-ec-green btn-sm" data-bs-toggle="modal" data-bs-target="#quoteModal" data-service-id="{{ $s->id }}">Demander un devis</button>
        </div>
    </div>
</div>
