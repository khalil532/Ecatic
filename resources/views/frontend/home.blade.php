@extends('layouts.app')

@section('title', ($site['seo_title'] ?? 'ECATIC Sénégal | Agrobusiness, Import-Export, Transport et Logistique'))
@section('description', ($site['seo_description'] ?? ''))

@section('content')
{{-- HERO --}}
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="{{ $brand['banner1'] ? 'col-lg-6' : 'col-lg-8' }} hero-content">
                <p class="eyebrow eyebrow-light reveal">Sébikotane · Dakar · Sénégal</p>
                <h1 class="reveal">{{ $site['company_name'] ?? 'ECATIC' }}</h1>
                <p class="hero-slogan reveal">« {{ $site['company_slogan'] ?? "Nous développons l'agrobusiness sénégalais et connectons l'Afrique au monde." }} »</p>
                <div class="d-flex flex-wrap gap-3 mt-4 reveal">
                    <a href="{{ route('activities') }}" class="btn btn-ec-gold btn-lg">Découvrir nos activités</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Nous contacter</a>
                </div>
            </div>
            @if($brand['banner1'])
                <div class="col-lg-6 reveal">
                    <div class="hero-banner">
                        <img src="{{ $brand['banner1'] }}" alt="ECATIC – Agrobusiness, Import &amp; Export – Sébikotane, Dakar, Sénégal" fetchpriority="high">
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- PRÉSENTATION RAPIDE --}}
<section class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                <p class="eyebrow">Qui sommes-nous</p>
                <h2 class="section-title">Une entreprise sénégalaise tournée vers l'Afrique et le monde</h2>
                <p class="text-muted">{{ $site['about_story'] ?? $site['company_intro'] ?? '' }}</p>
                <a href="{{ route('about') }}" class="btn btn-ec-green mt-2">En savoir plus <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
            <div class="col-lg-6 reveal">
                <div class="intro-panel">
                    <div class="row g-3 text-center">
                        <div class="col-4"><i class="fa-solid fa-seedling"></i><span>Agrobusiness</span></div>
                        <div class="col-4"><i class="fa-solid fa-globe-africa"></i><span>Import &amp; Export</span></div>
                        <div class="col-4"><i class="fa-solid fa-truck-fast"></i><span>Transport &amp; logistique</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TROIS DOMAINES --}}
<section class="section section-soft">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <p class="eyebrow">Nos activités</p>
            <h2 class="section-title center">Trois grands domaines d'activité</h2>
        </div>
        <div class="row g-4">
            @forelse($activities as $a)
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="activity-card h-100">
                        <div class="icon-circle"><i class="fa-solid {{ $a->icon }}"></i></div>
                        <h3 class="h4">{{ $a->title }}</h3>
                        <p class="text-muted">{{ $a->summary }}</p>
                        <a href="{{ route('activities') }}#{{ $a->slug }}" class="link-ec">Découvrir <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Les activités seront bientôt présentées ici.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- POURQUOI ECATIC --}}
<section class="section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <p class="eyebrow">Nos atouts</p>
            <h2 class="section-title center">Pourquoi choisir ECATIC&nbsp;?</h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['fa-location-dot', 'Ancrage au Sénégal', "Une entreprise basée à Sébikotane, au plus près des producteurs et des filières agricoles sénégalaises."],
                ['fa-earth-africa', 'Ouverture internationale', "Une vocation claire : connecter l'Afrique au monde grâce au commerce international."],
                ['fa-link', 'Une chaîne complète', "De l'agrobusiness à l'import-export, jusqu'au transport et à la logistique : des activités complémentaires."],
                ['fa-handshake', 'Partenariats durables', "Nous travaillons avec les producteurs, les coopératives, les entreprises et les partenaires internationaux."],
            ] as [$icon, $t, $d])
                <div class="col-sm-6 col-lg-3 reveal">
                    <div class="why-card h-100">
                        <i class="fa-solid {{ $icon }}"></i>
                        <h3 class="h6">{{ $t }}</h3>
                        <p class="small text-muted mb-0">{{ $d }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- VISION & AMBITIONS --}}
<section class="section section-green">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 reveal">
                <p class="eyebrow eyebrow-light">Notre vision</p>
                <h2 class="section-title text-white">Faire de l'agriculture sénégalaise un moteur de développement</h2>
                <p class="opacity-90">{{ $site['company_vision'] ?? '' }}</p>
            </div>
            <div class="col-lg-6 reveal">
                <div class="ambition-box">
                    <h3 class="h5 text-gold mb-3">Nos ambitions</h3>
                    <p class="mb-0 opacity-90">{{ $site['about_ambitions'] ?? $site['company_mission'] ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SÉNÉGAL & COMMERCE INTERNATIONAL --}}
<section class="senegal-section">
    @if($brand['banner2'])
        <img class="banner-strip" src="{{ $brand['banner2'] }}" alt="ECATIC – Agrobusiness, Import &amp; Export, Transport – Sébikotane, Dakar, Sénégal" loading="lazy">
    @endif
    <div class="section senegal-band">
        <div class="container text-center text-white reveal">
            <p class="eyebrow eyebrow-light">Le Sénégal, porte d'entrée de l'Afrique de l'Ouest</p>
            <h2 class="section-title center text-white">Valoriser le potentiel agricole sénégalais sur les marchés internationaux</h2>
            <p class="mx-auto opacity-90" style="max-width:760px">Le Sénégal dispose d'un potentiel agricole à valoriser. ECATIC contribue à développer les échanges commerciaux et à faciliter le transport et la distribution des produits agroalimentaires, du producteur au partenaire international.</p>
            <div class="flag-bar mx-auto mt-4"><span></span><span></span><span></span></div>
        </div>
    </div>
</section>

{{-- APPEL À L'ACTION --}}
<section class="section">
    <div class="container">
        <div class="cta-box text-center reveal">
            <h2 class="text-white">Partenaires, investisseurs, fournisseurs : construisons ensemble</h2>
            <p class="opacity-90 mx-auto" style="max-width:640px">Vous souhaitez collaborer avec ECATIC, importer ou exporter des produits agricoles, ou investir dans l'agrobusiness sénégalais ? Parlons de votre projet.</p>
            <div class="d-flex flex-wrap gap-3 justify-content-center mt-3">
                <a href="{{ route('contact', ['type' => 'partenariat', 'sujet' => 'Partenariat / investissement']) }}" class="btn btn-ec-gold btn-lg">Devenir partenaire</a>
                <a href="{{ route('services') }}" class="btn btn-outline-light btn-lg">Demander un devis</a>
            </div>
            @if(!empty($site['contact_email']))
                <p class="mt-4 mb-0 small opacity-90"><i class="fa-solid fa-envelope me-2 text-gold"></i><a class="text-white" href="mailto:{{ $site['contact_email'] }}">{{ $site['contact_email'] }}</a></p>
            @endif
        </div>
    </div>
</section>
@endsection
