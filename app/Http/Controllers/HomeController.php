<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\PostViewStat;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $featuredPosts = Post::with(['media', 'categories'])
            ->where('status', 1)
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        $latestQuery = Post::with(['media', 'categories'])
            ->where('status', 1);

        if ($request->integer('category')) {
            $categoryId = $request->integer('category');
            $latestQuery->whereHas('categories', fn($q) => $q->where('categories.id', $categoryId));
        }

        $latestPosts = $latestQuery->orderByDesc('published_at')
            ->limit(8)
            ->get();

        $sinceDate = now()->subDays(30)->toDateString();
        $popularStats = PostViewStat::selectRaw('post_id, SUM(views) as total_views')
            ->where('date', '>=', $sinceDate)
            ->groupBy('post_id')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        $popularPostIds = $popularStats->pluck('post_id')->all();
        $popularPostsMap = Post::with(['media', 'categories'])
            ->whereIn('id', $popularPostIds)
            ->get()
            ->keyBy('id');
        $popularPosts = collect($popularPostIds)
            ->map(fn ($id) => $popularPostsMap->get($id))
            ->filter()
            ->values();

        $topCategories = Category::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        $upcomingEvents = Event::where('event_date', '>=', now())
            ->orderBy('event_date')
            ->limit(3)
            ->get();

        $eventsArePast = false;
        if ($upcomingEvents->isEmpty()) {
            $upcomingEvents = Event::where('event_date', '<', now())
                ->orderByDesc('event_date')
                ->limit(3)
                ->get();
            $eventsArePast = true;
        }

        $recentComments = Comment::with(['post'])
            ->where('status', 1)
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $featuredGalleries = Gallery::with(['category', 'user'])
            ->where('status', 1)
            ->where('is_featured', true)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('home.index', compact(
            'featuredPosts',
            'latestPosts',
            'popularPosts',
            'topCategories',
            'upcomingEvents',
            'recentComments',
            'eventsArePast',
            'featuredGalleries'
        ));
    }
}
