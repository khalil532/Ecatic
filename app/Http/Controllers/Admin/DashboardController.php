<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\QuoteRequest;
use App\Models\Service;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Messages reçus sur les 6 derniers mois (calcul en PHP : compatible MySQL/SQLite)
        $months = collect(range(5, 0))->map(function ($i) {
            $d = now()->startOfMonth()->subMonths($i);
            return ['label' => $d->format('m/Y'), 'start' => $d, 'end' => $d->copy()->endOfMonth()];
        });

        $perMonth = $months->map(fn ($m) => [
            'label'  => $m['label'],
            'messages' => ContactMessage::whereBetween('created_at', [$m['start'], $m['end']])->count(),
            'quotes' => QuoteRequest::whereBetween('created_at', [$m['start'], $m['end']])->count(),
        ]);

        return view('admin.dashboard', [
            'stats' => [
                'messages'        => ContactMessage::count(),
                'messages_unread' => ContactMessage::where('is_read', false)->count(),
                'projects'        => Project::where('is_published', true)->count(),
                'services'        => Service::count(),
                'activities'      => Activity::count(),
                'quotes'          => QuoteRequest::count(),
                'quotes_new'      => QuoteRequest::where('status', 'nouveau')->count(),
            ],
            'perMonth'      => $perMonth,
            'maxPerMonth'   => max(1, $perMonth->map(fn ($m) => max($m['messages'], $m['quotes']))->max()),
            'latestMessages' => ContactMessage::latest()->take(5)->get(),
            'latestQuotes'   => QuoteRequest::with('service')->latest()->take(5)->get(),
        ]);
    }
}
