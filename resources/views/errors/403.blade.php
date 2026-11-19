@extends('layouts.app')
@section('title', 'Accès refusé | ECATIC')
@section('content')
<section class="section text-center">
    <div class="container">
        <p class="display-1 fw-bold text-gold">403</p>
        <h1 class="h3">Accès refusé</h1>
        <p class="text-muted">{{ $exception->getMessage() ?: "Vous n'avez pas l'autorisation d'accéder à cette page." }}</p>
        <a href="{{ route('home') }}" class="btn btn-ec-green mt-2">Retour à l'accueil</a>
    </div>
</section>
@endsection
