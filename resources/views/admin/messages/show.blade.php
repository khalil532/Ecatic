@extends('layouts.admin')
@section('title', 'Message')
@section('heading', 'Message de ' . $message->full_name)
@section('actions')<a href="{{ route('admin.messages.index') }}" class="btn btn-light">← Retour</a>@endsection

@section('content')
<div class="card-ec p-4">
    <div class="row g-3 mb-3">
        <div class="col-md-6"><strong>Nom :</strong> {{ $message->full_name }}</div>
        <div class="col-md-6"><strong>E-mail :</strong> <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
        <div class="col-md-6"><strong>Téléphone :</strong> {{ $message->phone ?: '—' }} @if($message->phone)<a class="ms-2" href="https://wa.me/{{ preg_replace('/\D/', '', $message->phone) }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp"></i></a>@endif</div>
        <div class="col-md-6"><strong>Entreprise :</strong> {{ $message->company ?: '—' }}</div>
        <div class="col-md-6"><strong>Type :</strong> {{ $message->type_label }}</div>
        <div class="col-md-6"><strong>Reçu le :</strong> {{ $message->created_at->format('d/m/Y à H:i') }}</div>
        <div class="col-12"><strong>Sujet :</strong> {{ $message->subject }}</div>
    </div>
    <div class="msg-body">{{ $message->message }}</div>
    <div class="d-flex flex-wrap gap-2 mt-4">
        <a class="btn btn-ec" href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: ' . $message->subject) }}"><i class="fa-solid fa-reply me-2"></i>Répondre par e-mail</a>
        <form method="POST" action="{{ route('admin.messages.handled', $message) }}">@csrf @method('PATCH')
            <button class="btn {{ $message->is_handled ? 'btn-outline-secondary' : 'btn-success' }}">{{ $message->is_handled ? 'Remettre « à traiter »' : 'Marquer comme traité' }}</button></form>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Supprimer ce message ?')">@csrf @method('DELETE')<button class="btn btn-outline-danger">Supprimer</button></form>
    </div>
</div>
@endsection
