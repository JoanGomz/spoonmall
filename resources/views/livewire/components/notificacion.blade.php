<div 
    x-data="{ show: @entangle('show') }"
    x-show="show"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-4 right-4 z-50"
>
    <!-- Aumentamos el tamaño del contenedor -->
    <div class="min-w-[300px] bg-white shadow-lg rounded-lg pointer-events-auto">
        <!-- Aumentamos el padding y el tamaño del texto -->
        <div class="p-6">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    @switch($type)
                        @case('success')
                            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                            @break
                        @case('error')
                            <i class="fas fa-times-circle text-red-500 text-2xl"></i>
                            @break
                        @case('warning')
                            <i class="fas fa-exclamation-circle text-yellow-500 text-2xl"></i>
                            @break
                        @case('info')
                            <i class="fas fa-info-circle text-blue-500 text-2xl"></i>
                            @break
                        @case('loading')
                            <div class="animate-spin text-blue-500 text-2xl">
                                <i class="fas fa-spinner"></i>
                            </div>
                            @break
                    @endswitch
                </div>
                <!-- Aumentamos el tamaño del texto del mensaje -->
                <div class="flex-1">
                    <p class="text-base font-medium text-gray-900">
                        {{ $message }}
                    </p>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <button 
                        wire:click="$set('show', false)"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none"
                    >
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>