<?php

namespace App\Http\Controllers;

use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroSliderController extends Controller
{
   
    public function index()
    {
        $sliders = HeroSlider::ordered()->get();
        return view('admin.hero-sliders.index', compact('sliders'));
    }


    public function create()
    {
        return view('admin.hero-sliders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image_type' => 'required|in:url,upload',
            'image_url' => 'required_if:image_type,url|nullable|url',
            'image_file' => 'required_if:image_type,upload|nullable|image|max:10240',
            'mobile_image_type' => 'required|in:url,upload',
            'mobile_image_url' => 'required_if:mobile_image_type,url|nullable|url',
            'mobile_image_file' => 'required_if:mobile_image_type,upload|nullable|image|max:10240',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->get('sort_order', 0);

        // Desktop Image Processing
        if ($data['image_type'] === 'upload' && $request->hasFile('image_file')) {
            $publicPath = $_SERVER['DOCUMENT_ROOT'];
            $heroSliderDir = $publicPath . '/hero_slider_images';
            
            if (!file_exists($heroSliderDir)) {
                mkdir($heroSliderDir, 0755, true);
            }
            
            $filename = time() . '_' . $request->file('image_file')->getClientOriginalName();
            $request->file('image_file')->move($heroSliderDir, $filename);
            $data['image'] = 'hero_slider_images/' . $filename;
        } elseif ($data['image_type'] === 'url') {
            $data['image'] = $data['image_url'];
        }

        // Mobile Image Processing
        if ($data['mobile_image_type'] === 'upload' && $request->hasFile('mobile_image_file')) {
            $publicPath = $_SERVER['DOCUMENT_ROOT'];
            $heroSliderDir = $publicPath . '/hero_slider_images';
            
            if (!file_exists($heroSliderDir)) {
                mkdir($heroSliderDir, 0755, true);
            }
            
            $filename = time() . '_mobile_' . $request->file('mobile_image_file')->getClientOriginalName();
            $request->file('mobile_image_file')->move($heroSliderDir, $filename);
            $data['mobile_image'] = 'hero_slider_images/' . $filename;
        } elseif ($data['mobile_image_type'] === 'url') {
            $data['mobile_image'] = $data['mobile_image_url'];
        }

        unset($data['image_file'], $data['image_url'], $data['image_type'], 
              $data['mobile_image_file'], $data['mobile_image_url'], $data['mobile_image_type']);

        HeroSlider::create($data);

        return redirect()->route('admin.hero-sliders.index')
            ->with('success', 'Hero slider başarıyla oluşturuldu.');
    }


    public function show(HeroSlider $heroSlider)
    {
        return view('admin.hero-sliders.show', compact('heroSlider'));
    }


    public function edit(HeroSlider $heroSlider)
    {
        return view('admin.hero-sliders.edit', compact('heroSlider'));
    }

    public function update(Request $request, HeroSlider $heroSlider)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image_type' => 'required|in:url,upload',
            'image_url' => 'required_if:image_type,url|nullable|url',
            'image_file' => 'nullable|image|max:10240',
            'mobile_image_type' => 'required|in:url,upload',
            'mobile_image_url' => 'required_if:mobile_image_type,url|nullable|url',
            'mobile_image_file' => 'nullable|image|max:10240',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->get('sort_order', 0);

        // Desktop Image Processing
        if ($data['image_type'] === 'upload' && $request->hasFile('image_file')) {
            if ($heroSlider->image && !str_starts_with($heroSlider->image, 'http')) {
                $publicPath = $_SERVER['DOCUMENT_ROOT'];
                $oldImagePath = $publicPath . '/' . $heroSlider->image;
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
            
            $publicPath = $_SERVER['DOCUMENT_ROOT'];
            $heroSliderDir = $publicPath . '/hero_slider_images';
            
            if (!file_exists($heroSliderDir)) {
                mkdir($heroSliderDir, 0755, true);
            }
            
            $filename = time() . '_' . $request->file('image_file')->getClientOriginalName();
            $request->file('image_file')->move($heroSliderDir, $filename);
            $data['image'] = 'hero_slider_images/' . $filename;
        } elseif ($data['image_type'] === 'url') {
            if ($heroSlider->image && !str_starts_with($heroSlider->image, 'http')) {
                $publicPath = $_SERVER['DOCUMENT_ROOT'];
                $oldImagePath = $publicPath . '/' . $heroSlider->image;
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
            $data['image'] = $data['image_url'];
        }

        // Mobile Image Processing
        if ($data['mobile_image_type'] === 'upload' && $request->hasFile('mobile_image_file')) {
            if ($heroSlider->mobile_image && !str_starts_with($heroSlider->mobile_image, 'http')) {
                $publicPath = $_SERVER['DOCUMENT_ROOT'];
                $oldImagePath = $publicPath . '/' . $heroSlider->mobile_image;
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
            
            $publicPath = $_SERVER['DOCUMENT_ROOT'];
            $heroSliderDir = $publicPath . '/hero_slider_images';
            
            if (!file_exists($heroSliderDir)) {
                mkdir($heroSliderDir, 0755, true);
            }
            
            $filename = time() . '_mobile_' . $request->file('mobile_image_file')->getClientOriginalName();
            $request->file('mobile_image_file')->move($heroSliderDir, $filename);
            $data['mobile_image'] = 'hero_slider_images/' . $filename;
        } elseif ($data['mobile_image_type'] === 'url') {
            if ($heroSlider->mobile_image && !str_starts_with($heroSlider->mobile_image, 'http')) {
                $publicPath = $_SERVER['DOCUMENT_ROOT'];
                $oldImagePath = $publicPath . '/' . $heroSlider->mobile_image;
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
            $data['mobile_image'] = $data['mobile_image_url'];
        }

        unset($data['image_file'], $data['image_url'], $data['image_type'], 
              $data['mobile_image_file'], $data['mobile_image_url'], $data['mobile_image_type']);

        $heroSlider->update($data);

        return redirect()->route('admin.hero-sliders.index')
            ->with('success', 'Hero slider başarıyla güncellendi.');
    }

    public function destroy(HeroSlider $heroSlider)
    {
        // Delete desktop image
        if ($heroSlider->image && !str_starts_with($heroSlider->image, 'http')) {
            $publicPath = $_SERVER['DOCUMENT_ROOT'];
            $imagePath = $publicPath . '/' . $heroSlider->image;
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
        }

        // Delete mobile image
        if ($heroSlider->mobile_image && !str_starts_with($heroSlider->mobile_image, 'http')) {
            $publicPath = $_SERVER['DOCUMENT_ROOT'];
            $mobileImagePath = $publicPath . '/' . $heroSlider->mobile_image;
            if (file_exists($mobileImagePath)) {
                @unlink($mobileImagePath);
            }
        }

        $heroSlider->delete();

        return redirect()->route('admin.hero-sliders.index')
            ->with('success', 'Hero slider başarıyla silindi.');
    }
}
