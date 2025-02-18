<div class="w-full bg-white rounded-lg shadow-sm border-black border-2 p-6">
    <form id="form">
        <div class="flex items-end gap-6">
            <!-- Campo Nombre -->
            <div class="flex flex-col flex-1">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Nombre
                </label>
                <input type="text" id="nombre" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                           dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingresa tu nombre">
            </div>

            <!-- Campo Descripción -->
            <div class="flex flex-col flex-1">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Descripción
                </label>
                <input type="text" id="descripcion" name="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                           dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="...">
            </div>

            <!-- Botón -->
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
                       font-medium rounded-lg text-sm px-5 py-2.5
                       dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Guardar
            </button>
        </div>
    </form>
</div>
@push('script-form')
    <script>
        const formulario = document.getElementById("form");

        formulario.addEventListener("submit", async (e) => {
            e.preventDefault();
            try {
                const formData = new FormData(formulario);
                const formDataObject = {};
                formData.forEach((value, key) => {
                    formDataObject[key] = value;
                });
                Livewire.dispatch('showNotification', ['Cargando', 'loading']);
                const response = await fetch("http://127.0.0.1:8000/api/tests", {
                    method: "POST",
                    body: JSON.stringify(formDataObject),
                    headers: {
                        "Content-Type": "application/json",
                    }
                });
                if(!response.ok){
                    await Livewire.dispatch('showNotification', ['Los datos no se han podido guardar', 'error']);
                }else{
                    await Livewire.dispatch('showNotification', ['Datos guardados correctamente', 'success']);
                }
            } catch (error) {
                console.error('Error:', error);
            }
            getData();
        })
    </script>
@endpush
