@extends('layouts.admin')
@section('title', 'Services')
@section('heading', 'Services')
@section('actions')<a href="{{ route('admin.services.create') }}" class="btn btn-ec"><i class="fa-solid fa-plus me-2"></i>Nouveau service</a>@endsection

@section('content')
<div class="card-ec table-responsive">
    <table class="table mb-0">
        <thead><tr><th>Ordre</th><th>Service</th><th>Activité</th><th>Statut</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse($items as $s)
            <tr>
                <td>{{ $s->sort_order }}</td>
                <td><i class="fa-solid {{ $s->icon }} text-success me-2"></i><strong>{{ $s->title }}</strong></td>
                <td>{{ $s->activity->title ?? '—' }}</td>
                <td>{!! $s->is_published ? '<span class="badge bg-success">Publié</span>' : '<span class="badge bg-secondary">Masqué</span>' !!}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('admin.services.edit', $s) }}" class="btn btn-sm btn-outline-success">Modifier</a>
                    <form class="d-inline" method="POST" action="{{ route('admin.services.destroy', $s) }}" onsubmit="return confirm('Supprimer ce service ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Supprimer</button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted py-4">Aucun service.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
