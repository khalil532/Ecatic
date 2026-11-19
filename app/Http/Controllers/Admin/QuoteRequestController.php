<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuoteRequestController extends Controller
{
    public function index()
    {
        return view('admin.quotes.index', [
            'items' => QuoteRequest::with('service')->latest()->paginate(15),
        ]);
    }

    public function update(Request $request, QuoteRequest $quote)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(QuoteRequest::STATUSES))],
        ]);
        $quote->update($data);

        return back()->with('success', 'Statut mis à jour.');
    }

    public function destroy(QuoteRequest $quote)
    {
        $quote->delete();

        return back()->with('success', 'Demande de devis supprimée.');
    }
}
