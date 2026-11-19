@extends('layouts.app')

@section('title', 'À propos | ECATIC Sénégal – Entreprise agricole et commerce international')
@section('description', "Découvrez ECATIC, entreprise sénégalaise basée à Sébikotane : notre mission, notre vision, nos valeurs et nos ambitions pour l'agrobusiness au Sénégal.")

@section('content')
@include('frontend.partials.page-header', ['eyebrow' => 'À propos', 'title' => 'À propos d\'ECATIC', 'subtitle' => "Développer l'agrobusiness sénégalais et connecter l'Afrique au monde."])

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7 reveal">
                <h2 class="section-title">Notre histoire et notre présentation</h2>
                <p class="text-muted">{!! nl2br(e($site['about_story'] ?? '')) !!}</p>
                <h3 class="h5 mt-4 text-ec">Notre identité</h3>
                <p class="text-muted">{!! nl2br(e($site['about_identity'] ?? '')) !!}</p>
            </div>
            <div class="col-lg-5 reveal">
                <div class="ambition-box mb-3">
                    <h3 class="h5 text-gold"><i class="fa-solid fa-bullseye me-2"></i>Notre mission</h3>
                    <p class="mb-0 opacity-90">{{ $site['company_mission'] ?? '' }}</p>
                </div>
                <div class="ambition-box">
                    <h3 class="h5 text-gold"><i class="fa-solid fa-eye me-2"></i>Notre vision</h3>
                    <p class="mb-0 opacity-90">{{ $site['company_vision'] ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <p class="eyebrow">Ce qui nous guide</p>
            <h2 class="section-title center">Nos valeurs</h2>
        </div>
        @php $values = array_values(array_filter(array_map('trim', preg_split('/\R/', $site['about_values'] ?? '')))); @endphp
        <div class="row g-3 justify-content-center">
            @foreach($values as $v)
                <div class="col-sm-6 col-lg-4 reveal">
                    <div class="value-item"><i class="fa-solid fa-circle-check"></i><span>{{ $v }}</span></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 reveal">
                <h2 class="h3 section-title">Nos ambitions pour l'agriculture sénégalaise</h2>
                <p class="text-muted">{!! nl2br(e($site['about_ambitions'] ?? '')) !!}</p>
            </div>
            <div class="col-md-6 reveal">
                <h2 class="h3 section-title">Notre engagement</h2>
                <p class="text-muted">{!! nl2br(e($site['about_commitment'] ?? '')) !!}</p>
                <a href="{{ route('contact') }}" class="btn btn-ec-green">Nous contacter</a>
            </div>
        </div>
    </div>
</section>
@endsection
