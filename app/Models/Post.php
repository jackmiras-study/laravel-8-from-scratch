<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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
        $query->when(
            key_exists("search", $filters),
            fn($query) => $query->where(fn($query) =>
                $query->where("title", "like", "%{$filters['search']}%")
                ->orWhere("body", "like", "%{$filters['search']}%")
            )
        );

        $query->when(
            key_exists("category", $filters),
            fn($query) =>
                $query->whereHas("category",fn($query) =>
                    $query->where("slug", $filters['category']))
            );

        $query->when(
            key_exists("author", $filters),
            fn($query) =>
                $query->whereHas("author",fn($query) =>
                    $query->where("username", $filters['author']))
            );

        return $query;
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
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
