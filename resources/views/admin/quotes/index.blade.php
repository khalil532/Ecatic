@extends('layouts.admin')
@section('title', 'Demandes de devis')
@section('heading', 'Demandes de devis')

@section('content')
<div class="card-ec table-responsive">
    <table class="table mb-0 align-middle">
        <thead><tr><th>Date</th><th>Demandeur</th><th>Service</th><th>Détails</th><th>Statut</th><th class="text-end"></th></tr></thead>
        <tbody>
        @forelse($items as $q)
            <tr>
                <td class="text-nowrap small">{{ $q->created_at->format('d/m/Y H:i') }}</td>
                <td><strong>{{ $q->full_name }}</strong><br><small><a href="mailto:{{ $q->email }}">{{ $q->email }}</a>@if($q->phone)<br>{{ $q->phone }}@endif @if($q->company)<br>{{ $q->company }}@endif</small></td>
                <td>{{ $q->service->title ?? 'Besoin général' }}</td>
                <td style="max-width:320px"><details><summary class="small text-success" style="cursor:pointer">Voir le détail</summary><div class="small mt-2" style="white-space:pre-wrap">{{ $q->details }}</div></details></td>
                <td>
                    <form method="POST" action="{{ route('admin.quotes.update', $q) }}" class="d-flex gap-1">@csrf @method('PATCH')
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            @foreach(\App\Models\QuoteRequest::STATUSES as $k => $label)<option value="{{ $k }}" @selected($q->status === $k)>{{ $label }}</option>@endforeach
                        </select>
                    </form>
                </td>
                <td class="text-end"><form method="POST" action="{{ route('admin.quotes.destroy', $q) }}" onsubmit="return confirm('Supprimer cette demande ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button></form></td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-4">Aucune demande de devis.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection
