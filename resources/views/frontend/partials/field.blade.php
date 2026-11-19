@php
    $id = $id ?? $name;
    $type = $type ?? 'text';
    $val = old($name, $value ?? '');
@endphp
<div class="{{ $col ?? 'col-12' }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if(!empty($required)) <span class="text-danger">*</span>@endif</label>
    @if($type === 'textarea')
        <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows ?? 5 }}" class="form-control @error($name) is-invalid @enderror" @if(!empty($required)) required @endif>{{ $val }}</textarea>
    @else
        <input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}" value="{{ $val }}" class="form-control @error($name) is-invalid @enderror" @if(!empty($required)) required @endif @if($type==='tel') inputmode="tel" @endif>
    @endif
    <div class="invalid-feedback">{{ $errors->first($name) }}</div>
</div>
