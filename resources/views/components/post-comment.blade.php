@props(["comment"])

<article class="flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-6">
    <div style="flex-shrink: 0;">
        <img src="https://i.pravatar.cc/60?u={{ $comment->id }}" alt="" width="60" height="60" class="rounded-xl">
    </div>

    <div>
        <header class="mb-5">
            <h3 class="font-bold">{{ $comment->author->username }}</h3>

            <p class="text-cs">
                Posted
                <time>{{ $comment->created_at }}</time>
            </p>
        </header>

        <p>
            {{ $comment->body }}
        </p>
    </div>
</article>
