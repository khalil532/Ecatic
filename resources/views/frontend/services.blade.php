@extends('layouts.app')

@section('title', 'Nos services | Import-Export, Logistique, Agrobusiness – ECATIC Sénégal')
@section('description', "Les prestations d'ECATIC : approvisionnement en produits agricoles, import-export, mise en relation commerciale, transport et logistique. Demandez un devis.")

@section('content')
@include('frontend.partials.page-header', ['eyebrow' => 'Nos services', 'title' => 'Nos services', 'subtitle' => 'Des prestations pour accompagner vos opérations agricoles, commerciales et logistiques.'])

<section class="section">
    <div class="container">
        @php
            $groups = $activities->filter(fn ($a) => $a->services->count());
        @endphp

        @foreach($groups as $a)
            <div class="mb-5">
                <h2 class="h3 section-title reveal"><i class="fa-solid {{ $a->icon }} me-2 text-gold"></i>{{ $a->title }}</h2>
                <div class="row g-4 mt-1">
                    @foreach($a->services as $s)
                        @include('frontend.partials.service-card', ['s' => $s])
                    @endforeach
                </div>
            </div>
        @endforeach

        @if($orphans->count())
            <div class="mb-5">
                <h2 class="h3 section-title reveal">Autres services</h2>
                <div class="row g-4 mt-1">
                    @foreach($orphans as $s)
                        @include('frontend.partials.service-card', ['s' => $s])
                    @endforeach
                </div>
            </div>
        @endif

        @if($groups->isEmpty() && $orphans->isEmpty())
            <p class="text-center text-muted">Les services seront bientôt présentés ici.</p>
        @endif

        <div class="cta-box text-center reveal mt-4">
            <h2 class="h3 text-white">Un besoin spécifique&nbsp;?</h2>
            <p class="opacity-90">Décrivez votre projet, nous vous répondrons avec une proposition adaptée.</p>
            <button type="button" class="btn btn-ec-gold btn-lg" data-bs-toggle="modal" data-bs-target="#quoteModal" data-service-id="">Demander un devis</button>
        </div>
    </div>
</section>

{{-- Modale : demande de devis --}}
<div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('quote.store') }}" data-ajax novalidate>
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title h5" id="quoteModalLabel">Demande de devis</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="q_service_id" class="form-label">Service concerné</label>
                            <select id="q_service_id" name="service_id" class="form-select">
                                <option value="">— Besoin général / autre —</option>
                                @foreach($allServices as $svc)
                                    <option value="{{ $svc->id }}">{{ $svc->title }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        @include('frontend.partials.field', ['name' => 'full_name', 'id' => 'q_full_name', 'label' => 'Nom complet', 'required' => true, 'col' => 'col-md-6'])
                        @include('frontend.partials.field', ['name' => 'email', 'id' => 'q_email', 'type' => 'email', 'label' => 'Adresse e-mail', 'required' => true, 'col' => 'col-md-6'])
                        @include('frontend.partials.field', ['name' => 'phone', 'id' => 'q_phone', 'type' => 'tel', 'label' => 'Téléphone', 'col' => 'col-md-6'])
                        @include('frontend.partials.field', ['name' => 'company', 'id' => 'q_company', 'label' => 'Entreprise', 'col' => 'col-md-6'])
                        @include('frontend.partials.field', ['name' => 'details', 'id' => 'q_details', 'type' => 'textarea', 'rows' => 4, 'label' => 'Décrivez votre besoin', 'required' => true])
                        <div class="d-none" aria-hidden="true"><label>Ne pas remplir <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-ec-green">Envoyer la demande</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
