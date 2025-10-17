<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'image_url',
        'image_path',
        'thumbnail_url',
        'thumbnail_path',
        'image_type',
        'alt_text',
        'sort_order',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute()
    {
        if ($this->image_type === 'url') {
            return $this->image_url;
        }
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    public function getThumbnailAttribute()
    {
        if ($this->image_type === 'url') {
            return $this->thumbnail_url ?: $this->image_url;
        }
        return $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : $this->image;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($gallery) {
            if (empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title);
            }
        });
    }
}
