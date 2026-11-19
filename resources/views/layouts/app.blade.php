<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $siteName  = $site['company_name'] ?? 'ECATIC';
        $metaTitle = trim($__env->yieldContent('title')) ?: ($site['seo_title'] ?? $siteName);
        $metaDesc  = trim($__env->yieldContent('description')) ?: ($site['seo_description'] ?? '');
        $ogImage   = trim($__env->yieldContent('og_image')) ?: ($brand['banner1'] ?? $brand['logo'] ?? null);
        $waNumber  = preg_replace('/\D/', '', $site['contact_whatsapp'] ?? '221772284871');
        $ld = [
            '@' . 'context' => 'https://schema.org',
            '@' . 'type'    => 'Organization',
            'name'          => $siteName,
            'url'           => url('/'),
            'telephone'     => $site['contact_phone'] ?? null,
            'email'         => $site['contact_email'] ?? null,
            'logo'          => $brand['logo'] ?? null,
            'address'       => [
                '@' . 'type'      => 'PostalAddress',
                'addressLocality' => 'Sébikotane',
                'addressRegion'   => 'Dakar',
                'addressCountry'  => 'SN',
            ],
        ];
    @endphp
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    <meta name="keywords" content="ECATIC Sénégal, agrobusiness Sénégal, entreprise agricole Sénégal, import export Sénégal, commerce international Sénégal, transport logistique Sénégal, produits agricoles sénégalais">
    <meta name="theme-color" content="#064B2D">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="fr_SN">
    @if($ogImage)<meta property="og:image" content="{{ $ogImage }}">@endif
    <meta name="twitter:card" content="summary_large_image">

    @if($brand['logo'])<link rel="icon" href="{{ $brand['logo'] }}">@endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/ecatic.css') }}" rel="stylesheet">

    <script type="application/ld+json">{!! json_encode($ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @stack('head')
</head>
<body>
    <a class="visually-hidden-focusable" href="#contenu">Aller au contenu</a>

    {{-- NAVIGATION --}}
    <nav class="navbar navbar-expand-lg ec-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                @if($brand['logo'])
                    <img src="{{ $brand['logo'] }}" alt="Logo {{ $siteName }}" height="56">
                @else
                    <span class="ec-wordmark">{{ $siteName }}</span>
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Ouvrir le menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">À propos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('activities') ? 'active' : '' }}" href="{{ route('activities') }}">Nos activités</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Nos services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('projects*') ? 'active' : '' }}" href="{{ route('projects') }}">Nos réalisations</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-ec-gold btn-sm px-3" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main id="contenu">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="ec-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="mb-3">
                        @if($brand['logo'])
                            <img src="{{ $brand['logo'] }}" alt="Logo {{ $siteName }}" height="52" class="footer-logo">
                        @else
                            <span class="ec-wordmark text-white">{{ $siteName }}</span>
                        @endif
                    </div>
                    <p class="small opacity-75">{{ $site['company_intro'] ?? '' }}</p>
                    <div class="d-flex gap-2 mt-3">
                        @foreach(['facebook' => 'fa-facebook-f', 'linkedin' => 'fa-linkedin-in', 'instagram' => 'fa-instagram', 'x' => 'fa-x-twitter'] as $net => $icon)
                            @if(!empty($site['social_' . $net]))
                                <a class="ec-social" href="{{ $site['social_' . $net] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($net) }}"><i class="fa-brands {{ $icon }}"></i></a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="footer-title">Navigation</h6>
                    <ul class="list-unstyled small footer-links">
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('about') }}">À propos</a></li>
                        <li><a href="{{ route('activities') }}">Nos activités</a></li>
                        <li><a href="{{ route('services') }}">Nos services</a></li>
                        <li><a href="{{ route('projects') }}">Nos réalisations</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="footer-title">Nos domaines</h6>
                    <ul class="list-unstyled small footer-links">
                        <li><a href="{{ route('activities') }}#agrobusiness">Agrobusiness</a></li>
                        <li><a href="{{ route('activities') }}#import-export">Import &amp; Export</a></li>
                        <li><a href="{{ route('activities') }}#transport-logistique">Transport et logistique</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="footer-title">Contact</h6>
                    <ul class="list-unstyled small footer-links">
                        <li><i class="fa-solid fa-location-dot me-2 text-gold"></i>{{ $site['contact_address'] ?? 'Sébikotane, Dakar, Sénégal' }}</li>
                        <li><i class="fa-solid fa-phone me-2 text-gold"></i><a href="tel:+{{ preg_replace('/\D/', '', $site['contact_phone'] ?? '221772284871') }}">{{ $site['contact_phone'] ?? '+221 77 228 48 71' }}</a></li>
                        <li><i class="fa-brands fa-whatsapp me-2 text-gold"></i><a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer">WhatsApp</a></li>
                        @if(!empty($site['contact_email']))
                            <li><i class="fa-solid fa-envelope me-2 text-gold"></i><a href="mailto:{{ $site['contact_email'] }}">{{ $site['contact_email'] }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <hr class="border-light opacity-25 mt-4">
            <p class="small text-center opacity-75 mb-0">&copy; {{ date('Y') }} {{ $siteName }} — Sébikotane, Dakar, Sénégal. Tous droits réservés.</p>
        </div>
    </footer>

    {{-- Bouton WhatsApp flottant --}}
    <a class="wa-float" href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer" aria-label="Discuter sur WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    {{-- Notifications --}}
    <div class="ec-toast-wrap" id="toastWrap" aria-live="polite">
        @if(session('success'))
            <div class="ec-toast ec-toast-success show" data-autohide><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="ec-toast ec-toast-error show" data-autohide>
                <i class="fa-solid fa-circle-exclamation me-2"></i>Veuillez corriger les champs signalés.
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/ecatic.js') }}"></script>
    @stack('scripts')
</body>
</html>
