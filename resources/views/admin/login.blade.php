<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Connexion administrateur | ECATIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body{min-height:100vh;display:grid;place-items:center;background:linear-gradient(135deg,#064B2D,#087443);font-family:system-ui,sans-serif}
        .box{background:#fff;border-radius:20px;padding:2.4rem;width:min(430px,92vw);box-shadow:0 25px 60px rgba(0,0,0,.3)}
        .brand{font-weight:800;letter-spacing:.1em;color:#064B2D;font-size:1.8rem}
        .btn-ec{background:#087443;color:#fff;border:0;padding:.7rem;font-weight:600;border-radius:50px}.btn-ec:hover{background:#064B2D;color:#fff}
        .form-control{border-radius:12px;padding:.7rem 1rem}
    </style>
</head>
<body>
<div class="box">
    <div class="text-center mb-4">
        @php $logo = collect(['png','jpg','jpeg','webp','svg'])->map(fn($e) => "images/logo.$e")->first(fn($p) => is_file(public_path($p))); @endphp
        @if($logo)<img src="{{ asset($logo) }}" alt="ECATIC" height="56">@else<div class="brand">ECATIC</div>@endif
        <p class="text-muted small mt-2 mb-0">Espace administrateur</p>
    </div>
    <form method="POST" action="{{ route('admin.login.post') }}" novalidate>
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Adresse e-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Mot de passe</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label small" for="remember">Rester connecté</label>
        </div>
        <button class="btn btn-ec w-100"><i class="fa-solid fa-lock me-2"></i>Se connecter</button>
    </form>
    <p class="text-center small mt-4 mb-0"><a href="{{ url('/') }}" class="text-muted text-decoration-none">← Retour au site</a></p>
</div>
</body>
</html>
