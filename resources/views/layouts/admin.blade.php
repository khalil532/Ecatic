<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Administration') | ECATIC Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
@php
    $unread = \App\Models\ContactMessage::where('is_read', false)->count();
    $newQuotes = \App\Models\QuoteRequest::where('status', 'nouveau')->count();
@endphp
<div class="adm-overlay" id="admOverlay" onclick="admToggle()"></div>
<aside class="adm-side" id="admSide">
    <a href="{{ route('admin.dashboard') }}" class="brand">ECATIC<small>ADMINISTRATION</small></a>
    <nav class="py-2">
        <a class="item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge"></i>Tableau de bord</a>
        <a class="item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope"></i>Messages @if($unread)<span class="badge bg-warning text-dark ms-auto">{{ $unread }}</span>@endif</a>
        <a class="item {{ request()->routeIs('admin.quotes.*') ? 'active' : '' }}" href="{{ route('admin.quotes.index') }}"><i class="fa-solid fa-file-invoice"></i>Demandes de devis @if($newQuotes)<span class="badge bg-warning text-dark ms-auto">{{ $newQuotes }}</span>@endif</a>
        <a class="item {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}" href="{{ route('admin.activities.index') }}"><i class="fa-solid fa-seedling"></i>Activités</a>
        <a class="item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}"><i class="fa-solid fa-briefcase"></i>Services</a>
        <a class="item {{ request()->routeIs('admin.projects.*') || request()->routeIs('admin.project-images.*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-images"></i>Réalisations</a>
        <a class="item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}"><i class="fa-solid fa-gear"></i>Paramètres du site</a>
        <hr class="border-light opacity-25 mx-3">
        <a class="item" href="{{ route('home') }}" target="_blank" rel="noopener"><i class="fa-solid fa-up-right-from-square"></i>Voir le site</a>
        <form method="POST" action="{{ route('admin.logout') }}" class="px-3 mt-2">
            @csrf
            <button class="btn btn-sm btn-outline-light w-100"><i class="fa-solid fa-right-from-bracket me-2"></i>Déconnexion</button>
        </form>
    </nav>
</aside>

<div class="adm-main">
    <div class="adm-top">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light adm-toggle" type="button" onclick="admToggle()" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
            <h1>@yield('heading')</h1>
        </div>
        <div>@yield('actions')</div>
    </div>

    @if(session('success'))<div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Veuillez corriger :</strong>
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    @yield('content')
</div>
<script>
function admToggle(){document.getElementById('admSide').classList.toggle('open');document.getElementById('admOverlay').classList.toggle('show');}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
