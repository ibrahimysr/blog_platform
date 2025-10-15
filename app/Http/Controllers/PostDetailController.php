<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostViewLog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Reaction;

class PostDetailController extends Controller
{
    public function show(Post $post): View
    {
        $post->load(['user', 'categories', 'media', 'comments.user'])
            ->loadCount([
                'reactions as likes_count' => function ($q) { $q->where('value', 1); },
                'reactions as dislikes_count' => function ($q) { $q->where('value', -1); },
            ]);
        
        $this->logView($post);
        
        $relatedPosts = Post::with(['media', 'categories', 'user'])
            ->where('status', 1)
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function($query) use ($post) {
                $query->whereIn('categories.id', $post->categories->pluck('id'));
            })
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('posts.show', compact('post', 'relatedPosts'));
    }
    
    private function logView(Post $post): void
    {
        PostViewLog::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'viewed_at' => now(),
        ]);
        
        $post->increment('views');
    }

    public function storeComment(Request $request, Post $post): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'content' => ['required','string','min:3','max:1000'],
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $data['content'],
            'status' => 1,
        ]);

        return back()->with('status', 'Yorum eklendi');
    }

    public function react(Request $request, Post $post): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'value' => ['required','in:1,-1'],
        ]);

        Reaction::updateOrCreate(
            ['post_id' => $post->id, 'user_id' => auth()->id()],
            ['value' => (int)$data['value']]
        );

        return back();
    }
}
