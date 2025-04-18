<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 mb-6">
    {{-- Cabecera del post --}}
    <div class="flex justify-between items-center mb-2">
        <h1 class="text-lg font-semibold text-gray-900">
            {{ $post->title }}
        </h1>
        <span class="text-sm text-gray-500">
            {{ $post->created_at->diffForHumans() }}
        </span>
    </div>

    {{-- Autor --}}
    <div class="text-sm text-gray-600 mb-4">
        Publicado por: <span class="font-medium text-indigo-600">{{ $post->user->name }}</span>
    </div>

    {{-- Contenido --}}
    <p class="text-gray-700 mb-4">
        {{ $post->content }}
    </p>

    {{-- Acciones --}}
    <div class="flex items-center justify-between text-sm text-gray-600 mt-4">
        <div class="flex items-center space-x-4">

            {{-- Likes --}}
            <form method="POST" action="{{ route('like.toggle', ['type' => 'post', 'id' => $post->id]) }}" class="flex items-center space-x-1">
                @csrf
                <button type="submit" class="flex items-center space-x-1 hover:text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                    </svg>
                    <span>{{ $likesCount }}</span>
                </button>
            </form>

            {{-- Comentarios --}}
            {{-- <div class="flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.984 8.984 0 01-4.9-1.45L2 17l1.45-3.1A8.984 8.984 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7z" clip-rule="evenodd" />
                </svg>
                <span>{{ $comments->count() }}</span>
            </div> --}}
        </div>

        {{-- Botón eliminar si es autor o admin --}}
        @if (Auth::check() && (Auth::user()->id == $post->user_id || Auth::user()->role->name == 'admin'))
            <form method="POST" action="{{ route('post.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">
                    Eliminar
                </button>
            </form>
        @endif
    </div>
</div>
