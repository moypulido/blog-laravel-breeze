{{-- resources/views/users_admin.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios Registrados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow p-6 rounded">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-3 text-center font-semibold">ID</th>
                        <th class="px-4 py-3 text-center font-semibold">Nombre</th>
                        <th class="px-4 py-3 text-center font-semibold">Email</th>
                        <th class="px-4 py-3 text-center font-semibold">Corazones</th>
                        <th class="px-4 py-3 text-center font-semibold">Comentarios Disponibles</th>
                        <th class="px-4 py-3 text-center font-semibold">Rol</th>
                        <th class="px-4 py-3 text-center font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 text-center align-middle">{{ $user->id }}</td>
                            <td class="px-4 py-2 text-center align-middle">{{ $user->name }}</td>
                            <td class="px-4 py-2 text-center align-middle">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-center align-middle">{{ $user->hearts ?? 0 }}</td>
                            <td class="px-4 py-2 text-center align-middle">{{ $user->available_comments ?? 0 }}</td>
                            <td class="px-4 py-2 text-center align-middle">
                                <form action="{{ route('user.updateRole', ['user' => $user->id]) }}" method="POST" class="flex flex-col items-center">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role_id" class="border rounded p-1 w-full text-center">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="mt-2 btn btn-primary text-blue-600 text-sm">Actualizar</button>
                                </form>
                            </td>
                            <td class="px-4 py-2 text-center align-middle">
                                @if (Auth::id() !== $user->id)
                                    <form action="{{ route('user.delete') }}" method="POST" class="flex flex-col items-center">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-danger text-red-600">Eliminar</button>
                                    </form>
                                @else
                                    <span class="text-gray-400">No puedes eliminarte</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
