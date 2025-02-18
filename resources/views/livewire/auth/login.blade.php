<div class="bg-gray-100 shadow-lg">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-xl shadow-lg">
            <!-- Logo o Título -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Wiglo</h2>
                <p class="mt-2 text-sm text-gray-600">Ingresa tus credenciales para acceder</p>
            </div>

            <!-- Formulario -->
            <form id="loginForm" class="mt-8 space-y-6" onsubmit="event.preventDefault(); login();">
                <div id="div_cred_error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"
                    style="display: none;">
                    <span class="block sm:inline">Usuario o contraseña incorrectos. Por favor, comuníquese con el
                        administrador.</span>
                </div>

                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="username" class="sr-only">Usuario</label>
                        <input id="username" name="username" type="text" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Usuario">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Contraseña</label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Contraseña">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
