<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public function __construct(
        public string $title,
        public string $excerpt,
        public int $date,
        public string $body,
        public string $slug) {}

    public static function all(): Collection
    {
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts/")))
                ->map(fn($file) => YamlFrontMatter::parseFile($file))
                ->map(fn ($document) => new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->body(),
                        $document->slug,
                    )
                )->sortByDesc("date");
        });
    }

    public static function find(string $slug): Post
    {
        return static::all()->firstWhere("slug", $slug);
    }
}