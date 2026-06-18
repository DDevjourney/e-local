<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('pedido.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" aria-label="Volver">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            </a>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Detalle del pedido</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Datos del pedido --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-4">Información del pedido</h3>
                <dl class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <dt class="text-xs text-gray-500 dark:text-gray-400">Cliente</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $pedido->cliente->nombre }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500 dark:text-gray-400">Fecha</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100 tabular-nums">{{ $pedido->fecha }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-gray-500 dark:text-gray-400 mb-1">Estado</dt>
                        <dd><x-status-badge :estado="$pedido->estado" /></dd>
                    </div>
                </dl>
            </div>

            {{-- Líneas del pedido --}}
            @php $total = $pedido->lineasPedido->sum(fn ($l) => $l->cantidad * $l->precio_unitario); @endphp
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Productos</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900/40">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Producto</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Cantidad</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Precio unitario</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                        @forelse ($pedido->lineasPedido as $linea)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $linea->producto->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-right tabular-nums text-gray-700 dark:text-gray-300">{{ $linea->cantidad }}</td>
                                <td class="px-6 py-4 text-sm text-right tabular-nums text-gray-700 dark:text-gray-300">{{ number_format($linea->precio_unitario, 2, ',', '.') }} €</td>
                                <td class="px-6 py-4 text-sm text-right tabular-nums text-gray-700 dark:text-gray-300">{{ number_format($linea->cantidad * $linea->precio_unitario, 2, ',', '.') }} €</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">Sin productos todavía. Añade uno abajo.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($pedido->lineasPedido->isNotEmpty())
                        <tfoot class="bg-gray-50 dark:bg-gray-900/40 border-t border-gray-200 dark:border-gray-700">
                            <tr>
                                <td colspan="3" class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total</td>
                                <td class="px-6 py-3 text-right text-sm font-semibold tabular-nums text-gray-900 dark:text-gray-100">{{ number_format($total, 2, ',', '.') }} €</td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>

            {{-- Añadir línea de pedido --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-4">Añadir producto</h3>
                <form action="{{ route('lineaspedido.store') }}" method="POST" x-data="{ enviando: false }" @submit="enviando = true" class="flex flex-col sm:flex-row sm:items-end gap-4">
                    @csrf
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">

                    <div class="flex-1">
                        <label for="producto_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Producto</label>
                        <select name="producto_id" id="producto_id"
                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm shadow-sm focus:border-accent-500 focus:ring-accent-500">
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full sm:w-32">
                        <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" min="1" value="1"
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm shadow-sm focus:border-accent-500 focus:ring-accent-500 tabular-nums">
                    </div>

                    <button type="submit" :disabled="enviando"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-accent-600 hover:bg-accent-700 dark:bg-accent-500 dark:hover:bg-accent-400 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors disabled:opacity-60 disabled:cursor-not-allowed">
                        <svg x-show="enviando" class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                        <span x-text="enviando ? 'Añadiendo…' : 'Añadir'">Añadir</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
