<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['nullable', 'integer', 'exists:services,id'],
            'full_name'  => ['required', 'string', 'max:120'],
            'email'      => ['required', 'email:rfc', 'max:150'],
            'phone'      => ['nullable', 'regex:/^[0-9+()\s.\-]{6,30}$/'],
            'company'    => ['nullable', 'string', 'max:150'],
            'details'    => ['required', 'string', 'min:10', 'max:5000'],
        ], [
            'full_name.required' => 'Veuillez indiquer votre nom complet.',
            'email.required'     => 'Veuillez indiquer votre adresse e-mail.',
            'details.required'   => 'Veuillez décrire votre besoin.',
            'details.min'        => 'Merci de détailler un peu plus votre besoin (10 caractères minimum).',
        ]);

        if (blank($request->input('website'))) {
            QuoteRequest::create($data + ['ip_address' => $request->ip()]);
        }

        $msg = 'Votre demande de devis a bien été envoyée. Nous revenons vers vous rapidement.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $msg]);
        }

        return back()->with('success', $msg);
    }
}
