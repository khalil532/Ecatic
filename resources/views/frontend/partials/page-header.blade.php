<section class="page-header">
    <div class="container position-relative">
        <p class="eyebrow mb-2">{{ $eyebrow ?? 'ECATIC' }}</p>
        <h1>{{ $title }}</h1>
        @isset($subtitle)<p class="lead mb-0">{{ $subtitle }}</p>@endisset
    </div>
</section>
