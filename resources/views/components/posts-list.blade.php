<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
    @if ($posts->count())
        <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
            <div>
                <a href="{{ route('posts.show', ['user' => $post->user,'post' => $post]) }}">
                    <img src="{{ asset('img/posts/'.$post->image) }}" alt="Imagen del post {{ $post->image }}">
                </a>
            </div>
            @endforeach
        </div>
        <div class="my-10"> 
            {{ $posts->links() }}
        </div>
    @else
        <p>Sigue a mas usuarios para ver sus posts...</p>
    @endif


    {{-- Ejemplo de Slots en component --}}
    {{-- {{ $title }} --}}
    {{-- <h1>{{ $slot }}</h1> --}}
    {{-- @if ($posts->count()) --}}
       {{-- <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"> --}}
            {{-- @foreach ($user->posts as $post) --}}
            {{-- @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['user' => $post->user,'post' => $post]) }}">
                        <img src="{{ asset('img/posts/'.$post->image) }}" alt="Imagen del post {{ $post->image }}">
                    </a>
                </div>
            @endforeach
        </div> --}}
        {{-- <div class="my-10"> --}}
            {{-- {{ $user->posts->links() }} --}}
            {{-- {{ $posts->links() }} --}}
            {{-- {{ $posts->links('pagination::tailwind') }} --}}
            {{-- {{ $posts->links('pagination::bootstrap-4') }} --}}
        {{-- </div> --}}
    {{-- @else
        <p>Sigue a mas usuarios para ver sus posts...</p> --}}
    {{-- @endif --}}
    {{-- <div class="mx-auto flex flex-col justify-center items-center">
    @forelse ($posts as $post)
        <div class="md:w-8/12 bg-white shadow rounded-xl text-bold p-6 my-3">
            <h2 class="text-2xl">
                {{ $post->title }}
            </h2>
        </div>
    @empty
        <p>Sigue a mas usuarios para ver sus posts...</p>
    @endforelse
    </div> --}}
</div>