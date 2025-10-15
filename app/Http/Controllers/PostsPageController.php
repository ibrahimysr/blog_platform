<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostViewStat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostsPageController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::with(['media', 'categories', 'user'])
            ->withCount([
                'reactions as likes_count' => function ($q) { $q->where('value', 1); },
                'reactions as dislikes_count' => function ($q) { $q->where('value', -1); },
            ])
            ->where('status', 1);

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($categoryId = $request->integer('category')) {
            $query->whereHas('categories', fn ($q) => $q->where('categories.id', $categoryId));
        }

        if ($request->input('sort') === 'popular') {
            $query->leftJoin('post_view_stats as pvs', 'pvs.post_id', '=', 'posts.id')
                  ->select('posts.*')
                  ->groupBy('posts.id')
                  ->orderByRaw('COALESCE(SUM(pvs.views), 0) DESC');
        } else {
            $query->orderByDesc('published_at');
        }

        $posts = $query->paginate(12)->withQueryString();

        $categories = Category::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(8)
            ->get();

        $activeCategory = $categoryId ? Category::find($categoryId) : null;

        return view('posts.index', compact('posts', 'categories', 'activeCategory'));
    }
}
