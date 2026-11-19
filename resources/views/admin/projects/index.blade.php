@extends('layouts.admin')
@section('title', 'Réalisations')
@section('heading', 'Réalisations / Projets')
@section('actions')<a href="{{ route('admin.projects.create') }}" class="btn btn-ec"><i class="fa-solid fa-plus me-2"></i>Nouveau projet</a>@endsection

@section('content')
<div class="card-ec table-responsive">
    <table class="table mb-0">
        <thead><tr><th></th><th>Projet</th><th>Catégorie</th><th>Images</th><th>Statut</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse($items as $p)
            <tr>
                <td>@if($p->cover_image)<img class="thumb" src="{{ asset($p->cover_image) }}" alt="">@else<div class="thumb"></div>@endif</td>
                <td><strong>{{ $p->title }}</strong>@if($p->is_demo) <span class="badge bg-warning text-dark">Démo</span>@endif</td>
                <td>{{ $p->category_label }}</td>
                <td>{{ $p->images_count }}</td>
                <td>{!! $p->is_published ? '<span class="badge bg-success">Publié</span>' : '<span class="badge bg-secondary">Masqué</span>' !!}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('admin.projects.edit', $p) }}" class="btn btn-sm btn-outline-success">Modifier</a>
                    <form class="d-inline" method="POST" action="{{ route('admin.projects.destroy', $p) }}" onsubmit="return confirm('Supprimer ce projet et toutes ses images ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Supprimer</button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Aucun projet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection
