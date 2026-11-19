@extends('layouts.app')

@section('title', 'Nos activités | Agrobusiness, Import-Export, Transport et Logistique – ECATIC')
@section('description', "Les activités d'ECATIC au Sénégal : agrobusiness, import-export et commerce international, transport de marchandises et logistique commerciale.")

@section('content')
@include('frontend.partials.page-header', ['eyebrow' => 'Nos activités', 'title' => 'Nos activités', 'subtitle' => 'Agrobusiness, import-export, transport et logistique : une approche complète.'])

@forelse($activities as $i => $a)
    <section class="section {{ $i % 2 ? 'section-soft' : '' }}" id="{{ $a->slug }}">
        <div class="container">
            <div class="row g-5 align-items-center {{ $i % 2 ? 'flex-lg-row-reverse' : '' }}">
                <div class="col-lg-6 reveal">
                    <div class="activity-visual">
                        @if($a->image)
                            <img src="{{ asset($a->image) }}" alt="{{ $a->title }}" loading="lazy">
                        @else
                            <div class="thumb-fallback"><i class="fa-solid {{ $a->icon }}"></i></div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <p class="eyebrow">Activité {{ $i + 1 }}</p>
                    <h2 class="section-title">{{ $a->title }}</h2>
                    <p class="text-muted">{!! nl2br(e($a->description)) !!}</p>
                    @if(!empty($a->highlights))
                        <ul class="check-list">
                            @foreach($a->highlights as $h)<li>{{ $h }}</li>@endforeach
                        </ul>
                    @endif
                    <a href="{{ route('contact', ['type' => 'information', 'sujet' => 'Information – ' . $a->title]) }}" class="btn btn-ec-green mt-2">Demander des informations</a>
                </div>
            </div>
        </div>
    </section>
@empty
    <section class="section"><div class="container text-center text-muted">Les activités seront bientôt présentées ici.</div></section>
@endforelse
@endsection
