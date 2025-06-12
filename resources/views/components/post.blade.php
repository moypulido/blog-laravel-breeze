<div class="bg-white border bg-gray-50 border rounded-lg shadow-sm p-6 mb-6">
    {{-- Post --}}
    <div class="flex items-start space-x-4">
        {{-- Avatar del autor --}}
        <div class="flex-shrink-0">
            <span class="inline-block h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg">
                {{ strtoupper(substr($post->user->name, 0, 1)) }}
            </span>
        </div>

        <div class="flex-1">
            {{-- Cabecera --}}
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold text-indigo-700">{{ $post->title }}</h1>
                <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
            </div>
            
            {{-- Autor --}}
            <div class="flex items-center space-x-2 mb-3">
                {{-- Autor --}}
                <p class="text-xs text-gray-500">
                    por <span class="font-semibold text-indigo-600">{{ $post->user->name }}</span>
                </p>
                {{-- Insignias del autor --}}
                @foreach ($post->user->badges as $badge)
                    <span class="inline-block bg-yellow-200 text-yellow-800 text-[10px] font-semibold px-1 py-0.5 rounded">
                        🏅 {{ $badge->name }}
                    </span>
                @endforeach
            </div>


            {{-- Contenido --}}
            <p class="text-gray-700 mb-5 border-l-4 border-indigo-200 pl-4 text-xl leading-relaxed">
                {{ $post->content }}
            </p>

            {{-- Acciones --}}
            <div class="flex items-center justify-between text-sm text-gray-500 mt-2">
                {{-- Hearts --}}
                <form method="POST" action="{{ route('heart.add', ['post' => $post->id]) }}" class="flex items-center space-x-1">
                    @csrf
                    @if(Auth::check() && Auth::user()->id == $post->user_id)
                        <button type="submit" class="flex items-center space-x-1 text-pink-500 opacity-50 cursor-not-allowed" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                            <span>{{ $post->hearts ?? 0 }}</span>
                        </button>
                    @else
                        <button type="submit" class="flex items-center space-x-1 text-pink-500 hover:text-pink-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                            <span>{{ $post->hearts ?? 0 }}</span>
                        </button>
                    @endif
                </form>

                {{-- Eliminar --}}
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

            {{-- Comentarios --}}
            <div class="mt-6 bg-gray-100 border border-gray-200 rounded-lg p-4">
                <h3 class="font-semibold mb-3 text-gray-800 flex items-center">
                    💬 Comentarios
                </h3>

                {{-- Lista de comentarios --}}
                <div class="space-y-3 max-h-60 overflow-y-auto">
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
                            <textarea name="content" required rows="2" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Escribe tu comentario..."></textarea>
                            <div class="flex justify-end mt-2">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-1 rounded hover:bg-indigo-700 transition">Comentar</button>
                            </div>
                        </form>
                    @else
                        <p class="text-red-500 mt-4 text-sm">No tienes comentarios disponibles.</p>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
