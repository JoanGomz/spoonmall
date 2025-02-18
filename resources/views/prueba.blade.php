<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PRUEBA CRUD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @livewireStyles
</head>

<body class="min-h-screen w-full flex flex-col">
    <h1>prueba</h1>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="w-4/5 px-4 space-y-8">
            <div class="w-full">
                @livewire('formulario')
            </div>
            <div class="w-full">
                @livewire('prueba')
            </div>
        </div>
        @livewire('components/notificacion')
    </div>

    @livewireScripts
    @stack('script-form')
    @stack('script-table')

    <!-- Script para auto-ocultar notificación -->
    <script>
        $wire.on('hide-notification', (event) => {
            setTimeout(() => {
                Livewire.dispatch('$set', 'show', false);
            }, event.delay || 3000);
        });
    </script>

    @stack('script-notificacion')
</body>

</html>
