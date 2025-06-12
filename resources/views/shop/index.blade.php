<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tienda
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Productos disponibles</h3>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                @if($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="border p-4 rounded shadow">
                                <h4 class="font-semibold text-lg">{{ $product->name }}</h4>
                                <p class="text-gray-600">{{ $product->description }}</p>
                                <p class="mt-2 font-bold text-red-500">❤️ {{ $product->price_hearts }} hearts</p>
    
                                <form action="{{ route('shop.buy', $product) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="ml-2 bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                                        Comprar
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No hay productos disponibles.</p>
                @endif

            </div>

            </div>
        </div>
    </div>
</x-app-layout>
