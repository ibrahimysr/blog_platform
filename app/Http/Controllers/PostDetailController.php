<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostViewLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostDetailController extends Controller
{
    public function show(Post $post): View
    {
        $post->load(['user', 'categories', 'media', 'comments.user']);
        
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
}
