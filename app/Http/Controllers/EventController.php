<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{
    public function show(Event $event): View
    {
        return view('pages.events.show', compact('event'));
    }

    public function plan(Event $event): View
    {
        return view('pages.events.plan', compact('event'));
    }

    public function toggleSave(Event $event)
    {
        $user = auth()->user();

        if ($user->savedEvents()->where('event_id', $event->id)->exists()) {
            $user->savedEvents()->detach($event->id);
            $message = 'Acara dihapus dari daftar simpanan.';
        } else {
            $user->savedEvents()->attach($event->id);
            $message = 'Acara berhasil disimpan.';
        }

        return back()->with('status', $message);
    }
}
