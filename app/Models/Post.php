<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "title",
        "slug",
        "excerpt",
        "body",
    ];

    protected $with = [
        "category",
        "author",
    ];

public function scopeFilter(Builder $query, array $filters): Builder
{
    return $query->when(
        key_exists("search", $filters),
        fn($query, $search) => $query
            ->where("title", "like", "%{$search}%")
            ->where("body", "like", "%{$search}%")
    );
}

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id');
    }
}
