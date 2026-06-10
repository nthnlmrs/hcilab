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
}
