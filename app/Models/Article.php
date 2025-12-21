<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category', // Keep for backward compatibility during migration
        'category_id',
        'slug',
        'content',
        'image',
        'status',
        'is_featured',
        'views',
        'published_at',
        'author_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categoryRel()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
