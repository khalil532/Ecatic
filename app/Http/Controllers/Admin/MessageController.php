<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filtre', 'tous');
        $query = ContactMessage::latest();

        if ($filter === 'non-lus') {
            $query->where('is_read', false);
        } elseif ($filter === 'a-traiter') {
            $query->where('is_handled', false);
        } elseif ($filter === 'traites') {
            $query->where('is_handled', true);
        }

        return view('admin.messages.index', [
            'items'  => $query->paginate(15)->withQueryString(),
            'filter' => $filter,
        ]);
    }

    public function show(ContactMessage $message)
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function toggleHandled(ContactMessage $message)
    {
        $message->update(['is_handled' => ! $message->is_handled]);

        return back()->with('success', $message->is_handled ? 'Message marqué comme traité.' : 'Message remis « à traiter ».');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé.');
    }
}
