<div class="bg-white border border-gray-200 rounded-2xl shadow p-6 mb-6">
    {{-- Cabecera del post --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold text-gray-900">{{ $post->title }}</h1>
        <span class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
    </div>

    {{-- Autor --}}
    <div class="text-sm text-gray-600 mb-4">
        Publicado por: <span class="font-medium text-indigo-600">{{ $post->user->name }}</span>
    </div>

    {{-- Contenido --}}
    <p class="text-gray-800 text-base leading-relaxed mb-4">{{ $post->content }}</p>

    {{-- Acciones --}}
    <div class="flex items-center justify-between text-sm text-gray-600 mt-4">
        <div class="flex items-center space-x-4">
            {{-- hearts --}}
            <form method="POST" action="{{ route('heart.add', ['post' => $post->id]) }}" class="flex items-center space-x-1">
                @csrf
                @if(Auth::check() && Auth::user()->id == $post->user_id)
                <button
                    type="submit"
                    class="flex items-center space-x-1 text-pink-500 opacity-50 cursor-not-allowed"
                    disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                    </svg>
                    <span>{{ $post->hearts ?? 0 }}</span>
                </button>
                @else
                <button
                    type="submit"
                    class="flex items-center space-x-1 text-pink-600 hover:text-pink-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                    </svg>
                    <span>{{ $post->hearts ?? 0 }}</span>
                </button>
                @endif
            </form>
        </div>

        {{-- Botón eliminar si es autor o admin --}}
        @if (Auth::check() && (Auth::user()->id == $post->user_id || Auth::user()->role->name == 'admin'))
        <form method="POST" action="{{ route('post.destroy', $post->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline hover:text-red-700">
                Eliminar
            </button>
        </form>
        @endif
    </div>

    {{-- Sección de comentarios --}}
    <div class="mt-6 bg-gray-50 rounded-lg p-5 border border-gray-200">
        <h3 class="font-semibold mb-4 text-gray-800 flex items-center text-base">
            <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2h2"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h-6a2 2 0 00-2 2v3a2 2 0 002 2h6a2 2 0 002-2V5a2 2 0 00-2-2z"></path>
            </svg>
            Comentarios
        </h3>

        <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
            @forelse($comments as $comment)
            <div class="flex items-start space-x-3 bg-white rounded-md p-3 shadow-sm border">
                <div class="flex-shrink-0">
                    <span class="inline-block h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                    </span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-indigo-700">{{ $comment->user->name }}</span>
                        <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700 mt-1">{{ $comment->content }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-sm">Sin comentarios aún.</p>
            @endforelse
        </div>

        {{-- Formulario para agregar comentario --}}
        @auth
        @if(Auth::user()->available_comments > 0)
        <form action="{{ route('comment.store') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="content" required rows="2" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-300" placeholder="Escribe tu comentario..."></textarea>
            <div class="flex justify-end mt-3">
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition-all shadow-sm">
                    Guardar comentario
                </button>
            </div>
        </form>
        @else
        <p class="text-red-500 mt-4 text-sm">No tienes comentarios disponibles.</p>
        @endif
        @endauth
    </div>
</div>