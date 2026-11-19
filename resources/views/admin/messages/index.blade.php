@extends('layouts.admin')
@section('title', 'Messages')
@section('heading', 'Messages des visiteurs')

@section('content')
<div class="mb-3 d-flex flex-wrap gap-2">
    @foreach(['tous' => 'Tous', 'non-lus' => 'Non lus', 'a-traiter' => 'À traiter', 'traites' => 'Traités'] as $k => $label)
        <a href="{{ route('admin.messages.index', ['filtre' => $k]) }}" class="btn btn-sm {{ $filter === $k ? 'btn-ec' : 'btn-outline-success' }}">{{ $label }}</a>
    @endforeach
</div>
<div class="card-ec table-responsive">
    <table class="table table-hover mb-0">
        <thead><tr><th>Date</th><th>Expéditeur</th><th>Sujet</th><th>Type</th><th>Statut</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse($items as $m)
            <tr class="{{ $m->is_read ? '' : 'fw-semibold' }}">
                <td class="text-nowrap small">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $m->full_name }}<br><small class="text-muted">{{ $m->email }}</small></td>
                <td>{{ \Illuminate\Support\Str::limit($m->subject, 50) }}</td>
                <td><small>{{ $m->type_label }}</small></td>
                <td>@unless($m->is_read)<span class="badge bg-warning text-dark">Nouveau</span> @endunless {!! $m->is_handled ? '<span class="badge bg-success">Traité</span>' : '<span class="badge bg-secondary">À traiter</span>' !!}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-sm btn-outline-success">Lire</a>
                    <form class="d-inline" method="POST" action="{{ route('admin.messages.destroy', $m) }}" onsubmit="return confirm('Supprimer ce message ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Aucun message.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection
