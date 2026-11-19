@extends('layouts.app')

@section('title', 'Nos réalisations | Projets agricoles, commerciaux et logistiques – ECATIC')
@section('description', "Galerie des réalisations d'ECATIC : projets agricoles, activités commerciales, opérations logistiques, partenariats et photographies de terrain.")

@section('content')
@include('frontend.partials.page-header', ['eyebrow' => 'Nos réalisations', 'title' => 'Nos réalisations', 'subtitle' => 'Projets agricoles, activités commerciales, opérations logistiques et partenariats.'])

<section class="section">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-5 reveal">
            <a href="{{ route('projects') }}" class="filter-pill {{ $category ? '' : 'active' }}">Tous</a>
            @foreach(\App\Models\Project::CATEGORIES as $key => $label)
                <a href="{{ route('projects', ['categorie' => $key]) }}" class="filter-pill {{ $category === $key ? 'active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>

        <div class="row g-4">
            @forelse($projects as $project)
                <div class="col-md-6 col-lg-4">@include('frontend.partials.project-card', ['project' => $project])</div>
            @empty
                <p class="text-center text-muted">Aucune réalisation publiée pour le moment.</p>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">{{ $projects->links() }}</div>
    </div>
</section>
@endsection
