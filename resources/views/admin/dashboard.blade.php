@extends('layouts.admin')
@section('title', 'Tableau de bord')
@section('heading', 'Tableau de bord')

@section('content')
<div class="row g-3 mb-4">
    @foreach([
        ['fa-envelope', $stats['messages'], 'Messages reçus' . ($stats['messages_unread'] ? " ({$stats['messages_unread']} non lus)" : ''), route('admin.messages.index')],
        ['fa-images', $stats['projects'], 'Projets publiés', route('admin.projects.index')],
        ['fa-briefcase', $stats['services'], 'Services', route('admin.services.index')],
        ['fa-file-invoice', $stats['quotes'], 'Demandes de devis' . ($stats['quotes_new'] ? " ({$stats['quotes_new']} nouvelles)" : ''), route('admin.quotes.index')],
        ['fa-seedling', $stats['activities'], 'Activités', route('admin.activities.index')],
    ] as [$icon, $num, $label, $url])
        <div class="col-sm-6 col-xl">
            <a href="{{ $url }}" class="text-decoration-none">
                <div class="card-ec stat"><div class="ico"><i class="fa-solid {{ $icon }}"></i></div><div><div class="num">{{ $num }}</div><div class="lbl">{{ $label }}</div></div></div>
            </a>
        </div>
    @endforeach
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="card-ec p-4 h-100">
            <h2 class="h6 fw-bold mb-3">Activité des 6 derniers mois</h2>
            @foreach($perMonth as $m)
                <div class="bar-row"><span class="lab">{{ $m['label'] }}</span>
                    <div class="flex-grow-1">
                        <div class="bar" style="width: {{ ($m['messages'] / $maxPerMonth) * 100 }}%"></div>
                        <div class="bar gold mt-1" style="width: {{ ($m['quotes'] / $maxPerMonth) * 100 }}%"></div>
                    </div>
                    <span class="text-muted">{{ $m['messages'] }} / {{ $m['quotes'] }}</span>
                </div>
            @endforeach
            <div class="small text-muted mt-3"><span class="badge" style="background:#087443">&nbsp;</span> Messages &nbsp; <span class="badge" style="background:#C6A23A">&nbsp;</span> Devis</div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card-ec p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2"><h2 class="h6 fw-bold mb-0">Derniers messages</h2><a href="{{ route('admin.messages.index') }}" class="small">Tout voir</a></div>
            @forelse($latestMessages as $m)
                <a href="{{ route('admin.messages.show', $m) }}" class="d-flex justify-content-between text-decoration-none text-dark py-2 border-bottom">
                    <span>@unless($m->is_read)<span class="badge bg-warning text-dark me-2">Nouveau</span>@endunless<strong>{{ $m->full_name }}</strong> — {{ \Illuminate\Support\Str::limit($m->subject, 45) }}</span>
                    <small class="text-muted">{{ $m->created_at->diffForHumans() }}</small>
                </a>
            @empty <p class="text-muted small mb-0">Aucun message pour le moment.</p> @endforelse
        </div>
        <div class="card-ec p-4">
            <div class="d-flex justify-content-between align-items-center mb-2"><h2 class="h6 fw-bold mb-0">Dernières demandes de devis</h2><a href="{{ route('admin.quotes.index') }}" class="small">Tout voir</a></div>
            @forelse($latestQuotes as $q)
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span><strong>{{ $q->full_name }}</strong> — {{ $q->service->title ?? 'Besoin général' }}</span>
                    <span class="badge bg-secondary">{{ \App\Models\QuoteRequest::STATUSES[$q->status] ?? $q->status }}</span>
                </div>
            @empty <p class="text-muted small mb-0">Aucune demande pour le moment.</p> @endforelse
        </div>
    </div>
</div>
@endsection
