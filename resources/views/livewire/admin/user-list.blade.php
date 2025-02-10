<div>
    <h1 class="text-xl font-bold mb-4">Administración de Usuarios</h1>

    <!-- Barra de búsqueda -->
    <input type="text" wire:model.debounce.300ms="search" placeholder="Buscar usuario..." class="border p-2 mb-4">

    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">ID</th>
                <th class="border p-2">Nombre</th>
                <th class="border p-2">Correo</th>
                <th class="border p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-center">
                    <td class="border p-2">{{ $user->id }}</td>
                    <td class="border p-2">{{ $user->name }}</td>
                    <td class="border p-2">{{ $user->email }}</td>
                    <td class="border p-2">
                        <button class="bg-blue-500 text-white px-2 py-1 rounded">Editar</button>
                        <button wire:click="delete({{ $user->id }})"
                            class="bg-red-500 text-white px-2 py-1 rounded"
                            onclick="confirm('¿Estás seguro de eliminar este usuario?') || event.stopImmediatePropagation();">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mt-2">
            {{ session('message') }}
        </div>
    @endif
    

    <!-- Paginación -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
