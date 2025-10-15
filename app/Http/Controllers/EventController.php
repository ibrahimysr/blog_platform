<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::with('category')->orderByDesc('event_date')->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.events.create', compact('categories'));
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['title']);
        }
        Event::create($data);
        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.events.edit', compact('event','categories'));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['title'], $event->id);
        }
        $event->update($data);
        return redirect()->route('admin.events.index');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();
        return redirect()->route('admin.events.index');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;
        while (Event::when($ignoreId, fn($q) => $q->where('id','!=',$ignoreId))->where('slug',$slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }
        return $slug;
    }
}
