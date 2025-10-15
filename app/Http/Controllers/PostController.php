<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{

    public function index(): View
    {
        $posts = Post::with(['categories', 'media', 'user'])->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }


    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $userId = auth()->id() ?: User::query()->value('id');
        $post = Post::create([
            'user_id' => $userId,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'excerpt' => $data['excerpt'] ?? null,
            'content' => $data['content'],
            'status' => $data['status'] ?? 0,
            'published_at' => $data['published_at'] ?? null,
            'is_featured' => $data['is_featured'] ?? false,
            'reading_time' => $data['reading_time'] ?? 0,
        ]);

        if (!empty($data['category_ids'])) {
            $post->categories()->sync($data['category_ids']);
        }

        if (!empty($data['media'])) {
            $mediaRecords = array_map(function ($m) {
                return [
                    'type' => $m['type'],
                    'url' => $m['url'],
                    'alt' => $m['alt'] ?? null,
                    'caption' => $m['caption'] ?? null,
                    'sort_order' => $m['sort_order'] ?? 0,
                    'is_primary' => $m['is_primary'] ?? false,
                ];
            }, $data['media']);
            $post->media()->createMany($mediaRecords);
        }

        return redirect()->route('admin.posts.edit', $post);
    }


    public function show(Post $post): View
    {
        $post->load(['categories', 'media', 'user']);
        return view('admin.posts.show', compact('post'));
    }

 
    public function edit(Post $post): View
    {
        $categories = Category::orderBy('name')->get();
        $post->load(['categories', 'media']);
        return view('admin.posts.edit', compact('post', 'categories'));
    }

 
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        $post->update([
            'title' => $data['title'] ?? $post->title,
            'slug' => $data['slug'] ?? $post->slug,
            'excerpt' => array_key_exists('excerpt', $data) ? $data['excerpt'] : $post->excerpt,
            'content' => $data['content'] ?? $post->content,
            'status' => $data['status'] ?? $post->status,
            'published_at' => array_key_exists('published_at', $data) ? $data['published_at'] : $post->published_at,
            'is_featured' => array_key_exists('is_featured', $data) ? (bool)$data['is_featured'] : $post->is_featured,
            'reading_time' => $data['reading_time'] ?? $post->reading_time,
        ]);

        if (array_key_exists('category_ids', $data)) {
            $post->categories()->sync($data['category_ids'] ?? []);
        }

        if (array_key_exists('media', $data)) {
            $post->media()->delete();
            if (!empty($data['media'])) {
                $mediaRecords = array_map(function ($m) {
                    return [
                        'type' => $m['type'],
                        'url' => $m['url'],
                        'alt' => $m['alt'] ?? null,
                        'caption' => $m['caption'] ?? null,
                        'sort_order' => $m['sort_order'] ?? 0,
                        'is_primary' => $m['is_primary'] ?? false,
                    ];
                }, $data['media']);
                $post->media()->createMany($mediaRecords);
            }
        }

        return redirect()->route('admin.posts.edit', $post);
    }

  
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
