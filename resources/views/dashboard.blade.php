<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- create post --}}
                    <div class="border border-gray-300 rounded-md p-4 shadow-sm">
                        <div class="max-w-3xl mx-auto">
                            <h1 class="text-2xl font-semibold mb-4">Crear Nueva Publicación</h1>
                            <form action="{{ route('post.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                                    <input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
                                    <textarea name="content" id="content" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="5" required></textarea>
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        Crear Publicación
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    {{-- posts --}}
                    @foreach ($posts as $post)
                        <x-post :post="$post"/>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
