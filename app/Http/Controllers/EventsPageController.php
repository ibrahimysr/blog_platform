<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventsPageController extends Controller
{
    public function index(): View
    {
        $baseQuery = Event::with(['category', 'user'])
            ->where('status', 1);

        if ($q = request('q')) {
            $baseQuery->where(function ($qB) use ($q) {
                $qB->where('title', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($cat = request('category')) {
            $baseQuery->where('category_id', $cat);
        }

        $upcomingEvents = (clone $baseQuery)
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->get();

        $pastEvents = (clone $baseQuery)
            ->where('event_date', '<', now())
            ->orderByDesc('event_date')
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('events.index', compact('upcomingEvents', 'pastEvents', 'categories'));
    }

    public function show(\App\Models\Event $event): View
    {
        $event->load(['category', 'user']);
        $related = \App\Models\Event::where('status', 1)
            ->where('id', '!=', $event->id)
            ->where('event_date', '>=', now()->subMonths(1))
            ->orderBy('event_date')
            ->limit(3)
            ->get();
        return view('events.show', compact('event', 'related'));
    }
}
