<x-layout>
    <article>
        <h1>
            <a href="/posts/{{ $post->slug }}">
                {!! $post->title !!}
            </a>
        </h1>

        <p>
        By <a href="#">{{ $post->user->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>

        <div>
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>
