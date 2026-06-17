<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('pedido.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                ← Volver
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detalle del pedido
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Datos del pedido --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Información del pedido</h3>
                <dl class="grid grid-cols-3 gap-4">
                    <div>
                        <dt class="text-xs text-gray-500 dark:text-gray-400">Cliente</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $pedido->cliente->nombre }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500 dark:text-gray-400">Fecha</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $pedido->fecha }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500 dark:text-gray-400">Estado</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $pedido->estado === 'completado' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-white' : '' }}
                                {{ $pedido->estado === 'enviado' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-white' : '' }}
                                {{ $pedido->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 text-white' : '' }}">
                                {{ ucfirst($pedido->estado) }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Líneas del pedido --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Productos</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Precio unitario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($pedido->lineasPedido as $linea)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $linea->producto->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $linea->cantidad }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ number_format($linea->precio_unitario, 2) }}€</td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ number_format($linea->cantidad * $linea->precio_unitario, 2) }}€</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Sin productos todavía. Añade uno abajo.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Añadir línea de pedido --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Añadir producto</h3>
                <form action="{{ route('lineaspedido.store') }}" method="POST" class="flex items-end gap-4">
                    @csrf
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">

                    <div class="flex-1">
                        <label for="producto_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Producto</label>
                        <select name="producto_id" id="producto_id"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-28">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" min="1" value="1"
                               class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                        Añadir
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>