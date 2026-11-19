@extends('layouts.app')

@section('title', 'Contact | ECATIC Sénégal – Sébikotane, Dakar')
@section('description', "Contactez ECATIC à Sébikotane (Dakar) : téléphone, WhatsApp, formulaire de contact pour vos demandes d'information, devis et partenariats.")

@section('content')
@include('frontend.partials.page-header', ['eyebrow' => 'Contact', 'title' => 'Contactez-nous', 'subtitle' => "Une question, un devis, un partenariat ? Écrivez-nous, nous répondons rapidement."])

@php
    $phoneDigits = preg_replace('/\D/', '', $site['contact_phone'] ?? '221772284871');
    $mapUrl = $site['google_maps_embed'] ?? '';
@endphp

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="contact-card reveal">
                    <div class="contact-line"><i class="fa-solid fa-location-dot"></i>
                        <div><strong>Adresse</strong><br>{{ $site['contact_address'] ?? 'Sébikotane, Dakar, Sénégal' }}</div></div>
                    <div class="contact-line"><i class="fa-solid fa-phone"></i>
                        <div><strong>Téléphone</strong><br><a href="tel:+{{ $phoneDigits }}">{{ $site['contact_phone'] ?? '+221 77 228 48 71' }}</a></div></div>
                    <div class="contact-line"><i class="fa-brands fa-whatsapp"></i>
                        <div><strong>WhatsApp</strong><br><a href="https://wa.me/{{ preg_replace('/\D/', '', $site['contact_whatsapp'] ?? '221772284871') }}" target="_blank" rel="noopener noreferrer">Discuter sur WhatsApp</a></div></div>
                    @if(!empty($site['contact_email']))
                        <div class="contact-line"><i class="fa-solid fa-envelope"></i>
                            <div><strong>E-mail</strong><br><a href="mailto:{{ $site['contact_email'] }}">{{ $site['contact_email'] }}</a></div></div>
                    @endif
                </div>

                <div class="map-box reveal mt-4">
                    @if($mapUrl)
                        <iframe src="{{ $mapUrl }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Carte – {{ $site['contact_address'] ?? 'Sébikotane' }}" allowfullscreen></iframe>
                    @else
                        <div class="map-placeholder"><i class="fa-solid fa-map-location-dot"></i><span>Carte Google Maps à configurer depuis l'espace administrateur (Paramètres → Coordonnées).</span></div>
                    @endif
                </div>
            </div>

            <div class="col-lg-7">
                <div class="form-card reveal">
                    <h2 class="h4 mb-4">Envoyez-nous un message</h2>
                    <form id="contact-form" method="POST" action="{{ route('contact.store') }}" data-ajax novalidate>
                        @csrf
                        <div class="row g-3">
                            @include('frontend.partials.field', ['name' => 'full_name', 'label' => 'Nom complet', 'required' => true, 'col' => 'col-md-6'])
                            @include('frontend.partials.field', ['name' => 'email', 'type' => 'email', 'label' => 'Adresse e-mail', 'required' => true, 'col' => 'col-md-6'])
                            @include('frontend.partials.field', ['name' => 'phone', 'type' => 'tel', 'label' => 'Téléphone', 'col' => 'col-md-6'])
                            @include('frontend.partials.field', ['name' => 'company', 'label' => 'Entreprise', 'col' => 'col-md-6'])
                            @include('frontend.partials.field', ['name' => 'subject', 'label' => 'Sujet de la demande', 'required' => true, 'col' => 'col-md-7', 'value' => $prefill['subject'] ?? ''])
                            <div class="col-md-5">
                                <label for="request_type" class="form-label">Type de demande <span class="text-danger">*</span></label>
                                <select id="request_type" name="request_type" class="form-select @error('request_type') is-invalid @enderror" required>
                                    @foreach(\App\Models\ContactMessage::TYPES as $k => $label)
                                        <option value="{{ $k }}" @selected(old('request_type', $prefill['request_type'] ?? 'information') === $k)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('request_type') }}</div>
                            </div>
                            @include('frontend.partials.field', ['name' => 'message', 'type' => 'textarea', 'rows' => 6, 'label' => 'Message', 'required' => true])
                            <div class="d-none" aria-hidden="true"><label>Ne pas remplir <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-ec-green btn-lg"><i class="fa-solid fa-paper-plane me-2"></i>Envoyer le message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
