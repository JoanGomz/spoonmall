<div class="relative overflow-x-auto shadow-md sm:rounded-lg border-black border-2">
    <table class="w-full min-w-80 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Descripción</th>
                <th scope="col" class="px-6 py-3">Creado</th>
                <th scope="col" class="px-6 py-3">Actualizado</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody id="body-table"></tbody>
    </table>
    <!-- Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Registro</h3>
                <div class="mt-2 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="editName"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <input type="text" id="editDescription"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2.5">
                    </div>
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancelar
                    </button>
                    <button onclick="updateData()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script-table')
    <script>
        const body = document.getElementById("body-table");

        async function getData() {
            try {
                const response = await fetch("http://127.0.0.1:8000/api/tests");
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                } else {
                    
                }
                const data = await response.json();

                body.innerHTML = data.map(d => `
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">${d.id || ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${d.name || ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${d.description || ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${d.created_at || ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${d.updated_at || ''}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <button onclick="openEditModal(${d.id})" class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-edit"></i>
                </button>

                                <button data-id="${d.id}" class="text-red-600 hover:text-red-900" onclick="deleteData(${d.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                console.error('Error:', error);
                body.innerHTML = '<tr><td colspan="5">Error al cargar los datos</td></tr>';
            }
        }

        async function deleteData(id) {
            try {
                Livewire.dispatch('showNotification', ['Cargando', 'loading']);
                const response = await fetch(`http://127.0.0.1:8000/api/tests/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json"
                    }
                });
                
                if (!response.ok) {
                    Livewire.dispatch('showNotification', ['Los datos no se han podido eliminar', 'error']);
                }else{
                    Livewire.dispatch('showNotification', ['Datos borrados correctamente', 'success']);
                }
            } catch (error) {
                console.error('Error:', error)
            }
            getData();
        }

        getData();
        let currentEditId = null;
        const editModal = document.getElementById('editModal');
        const editNameInput = document.getElementById('editName');
        const editDescriptionInput = document.getElementById('editDescription');

        async function openEditModal(id) {
            try {
                const response = await fetch(`http://127.0.0.1:8000/api/tests/${id}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();

                // Guardar el ID actual y llenar los inputs
                currentEditId = id;
                editNameInput.value = data.name || '';
                editDescriptionInput.value = data.description || '';

                // Mostrar modal
                editModal.classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
                alert('Error al cargar los datos');
            }
        }

        function closeEditModal() {
            editModal.classList.add('hidden');
            currentEditId = null;
        }

        async function updateData() {
            if (!currentEditId) return;

            try {
                
                Livewire.dispatch('showNotification', ['Cargando', 'loading']);
                const response = await fetch(`http://127.0.0.1:8000/api/tests/${currentEditId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: editNameInput.value,
                        description: editDescriptionInput.value
                    })
                });

                if (!response.ok) {
                    Livewire.dispatch('showNotification', ['No se han podido actualizar los datos', 'error']);
                }else{
                    Livewire.dispatch('showNotification', ['Datos actualizados', 'success']);
                }

                // Cerrar modal y actualizar tabla
                closeEditModal();
                getData();

            } catch (error) {
                console.error('Error:', error);
                alert('Error al actualizar los datos');
            }
        }

        getData();
    </script>
@endpush
