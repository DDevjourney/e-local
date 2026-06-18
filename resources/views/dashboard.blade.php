<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
            Panel
        </h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Hola, {{ Auth::user()->name }}. Resumen general de tu comercio.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Métricas --}}
            @php
                $metricas = [
                    ['label' => 'Productos', 'valor' => $totalProductos, 'ruta' => route('producto.index')],
                    ['label' => 'Clientes', 'valor' => $totalClientes, 'ruta' => route('cliente.index')],
                    ['label' => 'Pedidos', 'valor' => $totalPedidos, 'ruta' => route('pedido.index')],
                    ['label' => 'Categorías', 'valor' => $totalCategorias, 'ruta' => route('categoria.index')],
                ];
            @endphp
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($metricas as $m)
                    <a href="{{ $m['ruta'] }}"
                       class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-5 hover:border-accent-400 dark:hover:border-accent-500 transition-colors">
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ $m['label'] }}</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100 tabular-nums">{{ $m['valor'] }}</p>
                        <p class="mt-3 text-xs font-medium text-accent-700 dark:text-accent-400 opacity-0 group-hover:opacity-100 transition-opacity">Ver todo →</p>
                    </a>
                @endforeach
            </div>

            {{-- Accesos rápidos --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Acciones rápidas</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @php
                        $acciones = [
                            ['t' => 'Nuevo producto', 'd' => 'Añade un artículo al inventario.', 'r' => route('producto.create')],
                            ['t' => 'Nuevo cliente', 'd' => 'Registra un cliente nuevo.', 'r' => route('cliente.create')],
                            ['t' => 'Nuevo pedido', 'd' => 'Crea y gestiona un pedido.', 'r' => route('pedido.create')],
                            ['t' => 'Nueva categoría', 'd' => 'Organiza tu catálogo.', 'r' => route('categoria.create')],
                        ];
                    @endphp
                    @foreach ($acciones as $a)
                        <a href="{{ $a['r'] }}"
                           class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $a['t'] }}</p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $a['d'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
