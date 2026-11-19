<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        return view('frontend.contact', [
            'prefill' => [
                'request_type' => $request->query('type'),
                'subject'      => $request->query('sujet'),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'    => ['required', 'string', 'max:120'],
            'email'        => ['required', 'email:rfc', 'max:150'],
            'phone'        => ['nullable', 'regex:/^[0-9+()\s.\-]{6,30}$/'],
            'company'      => ['nullable', 'string', 'max:150'],
            'subject'      => ['required', 'string', 'max:180'],
            'request_type' => ['required', Rule::in(array_keys(ContactMessage::TYPES))],
            'message'      => ['required', 'string', 'min:10', 'max:5000'],
        ], [
            'full_name.required' => 'Veuillez indiquer votre nom complet.',
            'email.required'     => 'Veuillez indiquer votre adresse e-mail.',
            'email.email'        => "L'adresse e-mail n'est pas valide.",
            'phone.regex'        => "Le numéro de téléphone n'est pas valide.",
            'subject.required'   => 'Veuillez indiquer le sujet de votre demande.',
            'message.required'   => 'Veuillez écrire votre message.',
            'message.min'        => 'Votre message est trop court (10 caractères minimum).',
        ]);

        // Champ-piège anti-spam : un robot le remplit, un humain ne le voit pas
        if (filled($request->input('website'))) {
            return $this->done($request);
        }

        ContactMessage::create($data + ['ip_address' => $request->ip()]);

        return $this->done($request);
    }

    private function done(Request $request)
    {
        $msg = 'Merci ! Votre message a bien été envoyé. Nous vous répondrons très bientôt.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $msg]);
        }

        return redirect()->route('contact')->with('success', $msg);
    }
}
