@extends('layouts.admin')
@section('title', 'Activités')
@section('heading', 'Activités')
@section('actions')<a href="{{ route('admin.activities.create') }}" class="btn btn-ec"><i class="fa-solid fa-plus me-2"></i>Nouvelle activité</a>@endsection

@section('content')
<div class="card-ec table-responsive">
    <table class="table mb-0">
        <thead><tr><th>Ordre</th><th>Titre</th><th>Services</th><th>Statut</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse($items as $a)
            <tr>
                <td>{{ $a->sort_order }}</td>
                <td><i class="fa-solid {{ $a->icon }} text-success me-2"></i><strong>{{ $a->title }}</strong></td>
                <td>{{ $a->services()->count() }}</td>
                <td>{!! $a->is_published ? '<span class="badge bg-success">Publiée</span>' : '<span class="badge bg-secondary">Masquée</span>' !!}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('admin.activities.edit', $a) }}" class="btn btn-sm btn-outline-success">Modifier</a>
                    <form class="d-inline" method="POST" action="{{ route('admin.activities.destroy', $a) }}" onsubmit="return confirm('Supprimer cette activité ? Les services liés seront conservés.')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Supprimer</button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted py-4">Aucune activité.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
