@extends('layouts.app')

@section('title', $project->title . ' | Réalisations ECATIC')
@section('description', \Illuminate\Support\Str::limit($project->summary, 155))
@if($project->cover_image)@section('og_image', asset($project->cover_image))@endif

@section('content')
@include('frontend.partials.page-header', ['eyebrow' => $project->category_label, 'title' => $project->title])

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($project->is_demo)
                    <div class="alert alert-warning"><i class="fa-solid fa-circle-info me-2"></i>Contenu de démonstration : cette réalisation sera remplacée par une information officielle.</div>
                @endif
                @if($project->cover_image)
                    <img class="img-fluid rounded-4 shadow-sm mb-4" src="{{ asset($project->cover_image) }}" alt="{{ $project->title }}">
                @endif
                <p class="lead">{{ $project->summary }}</p>
                @if($project->description)<p class="text-muted">{!! nl2br(e($project->description)) !!}</p>@endif

                @if($project->images->count())
                    <h2 class="h4 section-title mt-5">Galerie</h2>
                    <div class="row g-3">
                        @foreach($project->images as $img)
                            <div class="col-6 col-md-4">
                                <a href="{{ asset($img->path) }}" target="_blank" rel="noopener"><img class="gallery-img" src="{{ asset($img->path) }}" alt="{{ $img->caption ?: $project->title }}" loading="lazy"></a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="side-card">
                    <h2 class="h6 text-uppercase text-gold">Informations</h2>
                    <ul class="list-unstyled small mb-3">
                        <li class="mb-2"><strong>Catégorie :</strong> {{ $project->category_label }}</li>
                        @if($project->location)<li class="mb-2"><strong>Lieu :</strong> {{ $project->location }}</li>@endif
                        @if($project->project_date)<li class="mb-2"><strong>Date :</strong> {{ $project->project_date->format('d/m/Y') }}</li>@endif
                    </ul>
                    <a href="{{ route('contact', ['sujet' => 'À propos de : ' . $project->title]) }}" class="btn btn-ec-gold w-100">Nous contacter</a>
                    <a href="{{ route('projects') }}" class="btn btn-link w-100 mt-2">← Toutes les réalisations</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
