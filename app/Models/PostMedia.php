<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'type',
        'url',
        'alt',
        'caption',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
