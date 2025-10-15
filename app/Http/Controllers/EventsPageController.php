<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\View\View;

class EventsPageController extends Controller
{
    public function index(): View
    {
        $query = Event::with(['category', 'user'])
            ->where('status', 1)
            ->orderBy('event_date');

        if ($q = request('q')) {
            $query->where(function ($qB) use ($q) {
                $qB->where('title', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%");
            });
        }

        if ($cat = request('category')) {
            $query->where('category_id', $cat);
        }

        if ($when = request('when')) {
            if ($when === 'past') $query->where('event_date', '<', now());
            if ($when === 'upcoming') $query->where('event_date', '>=', now());
        } else {
            $query->where('event_date', '>=', now()->subMonths(1));
        }

        $events = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('events.index', compact('events', 'categories'));
    }
}
