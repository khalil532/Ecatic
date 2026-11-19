@extends('layouts.app')
@section('title', 'Page introuvable | ECATIC')
@section('content')
<section class="section text-center">
    <div class="container">
        <p class="display-1 fw-bold text-gold">404</p>
        <h1 class="h3">Page introuvable</h1>
        <p class="text-muted">La page que vous cherchez n'existe pas ou a été déplacée.</p>
        <a href="{{ route('home') }}" class="btn btn-ec-green mt-2">Retour à l'accueil</a>
    </div>
</section>
@endsection
