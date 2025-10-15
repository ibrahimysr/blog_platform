<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostViewStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'date',
        'views',
        'unique_views',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
