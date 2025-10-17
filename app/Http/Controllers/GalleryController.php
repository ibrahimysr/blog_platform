<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    // Public gallery index
    public function index(Request $request): View
    {
        $query = Gallery::with(['category', 'user'])
            ->where('status', 1);

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($categoryId = $request->integer('category')) {
            $query->where('category_id', $categoryId);
        }

        if ($request->input('sort') === 'featured') {
            $query->where('is_featured', true);
        }

        $query->orderBy('sort_order')->orderByDesc('created_at');

        $galleries = $query->paginate(12)->withQueryString();

        $categories = Category::withCount('galleries')
            ->orderByDesc('galleries_count')
            ->limit(8)
            ->get();

        $activeCategory = $categoryId ? Category::find($categoryId) : null;

        return view('galleries.index', compact('galleries', 'categories', 'activeCategory'));
    }

    // Admin gallery index
    public function adminIndex(Request $request): View
    {
        $query = Gallery::with(['category', 'user']);

        if ($search = trim((string) $request->input('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($categoryId = $request->integer('category')) {
            $query->where('category_id', $categoryId);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $query->orderByDesc('created_at');

        $galleries = $query->paginate(15)->withQueryString();

        $categories = Category::all();

        return view('admin.galleries.index', compact('galleries', 'categories'));
    }

    public function show(Gallery $gallery): View
    {
        $gallery->load(['category', 'user']);
        
        $relatedGalleries = Gallery::with(['category', 'user'])
            ->where('status', 1)
            ->where('id', '!=', $gallery->id)
            ->where('category_id', $gallery->category_id)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('galleries.show', compact('gallery', 'relatedGalleries'));
    }

    // Admin methods

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_type' => 'required|in:url,upload',
            'image_url' => 'required_if:image_type,url|nullable|url',
            'image_file' => 'required_if:image_type,upload|nullable|image|max:10240',
            'thumbnail_url' => 'nullable|url',
            'thumbnail_file' => 'nullable|image|max:5120',
            'alt_text' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|integer|in:0,1,2',
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = $data['title'] ? Str::slug($data['title']) : 'gallery-' . time();

        // Handle image upload/URL
        if ($data['image_type'] === 'upload' && $request->hasFile('image_file')) {
            $data['image_path'] = $request->file('image_file')->store('galleries', 'public');
        }

        // Handle thumbnail upload/URL
        if ($request->hasFile('thumbnail_file')) {
            $data['thumbnail_path'] = $request->file('thumbnail_file')->store('galleries/thumbnails', 'public');
        }

        // Remove file fields from data
        unset($data['image_file'], $data['thumbnail_file']);

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('status', 'Galeri resmi eklendi');
    }

    public function edit(Gallery $gallery): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_type' => 'required|in:url,upload',
            'image_url' => 'required_if:image_type,url|nullable|url',
            'image_file' => 'nullable|image|max:10240',
            'thumbnail_url' => 'nullable|url',
            'thumbnail_file' => 'nullable|image|max:5120',
            'alt_text' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|integer|in:0,1,2',
        ]);

        $data['slug'] = $data['title'] ? Str::slug($data['title']) : 'gallery-' . time();

        // Handle image upload/URL
        if ($data['image_type'] === 'upload' && $request->hasFile('image_file')) {
            // Delete old image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image_file')->store('galleries', 'public');
        } elseif ($data['image_type'] === 'url') {
            $data['image_path'] = null;
        }

        // Handle thumbnail upload/URL
        if ($request->hasFile('thumbnail_file')) {
            // Delete old thumbnail
            if ($gallery->thumbnail_path) {
                Storage::disk('public')->delete($gallery->thumbnail_path);
            }
            $data['thumbnail_path'] = $request->file('thumbnail_file')->store('galleries/thumbnails', 'public');
        }

        // Remove file fields from data
        unset($data['image_file'], $data['thumbnail_file']);

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('status', 'Galeri resmi güncellendi');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        // Delete files
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        if ($gallery->thumbnail_path) {
            Storage::disk('public')->delete($gallery->thumbnail_path);
        }

        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('status', 'Galeri resmi silindi');
    }
}
