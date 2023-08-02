<x-layout>
    {{-- Views where the name starts with _ are partial views or simply partials --}}
    @include("posts._header")

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->isNotEmpty())
            <x-posts-grid :posts="$posts" />
        @else
            <p class="text-center">No posts yet. Please check back</p>
        @endif
    </main>
</x-layout>
