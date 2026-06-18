@props(['estado'])

@php
    $estado = strtolower($estado ?? '');

    $estilos = [
        'completado' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300',
        'enviado'    => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300',
        'pendiente'  => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300',
    ];
    $puntos = [
        'completado' => 'bg-green-500',
        'enviado'    => 'bg-blue-500',
        'pendiente'  => 'bg-amber-500',
    ];

    $clase = $estilos[$estado] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
    $punto = $puntos[$estado] ?? 'bg-gray-400';
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $clase }}">
    <span class="w-1.5 h-1.5 rounded-full {{ $punto }}"></span>
    {{ ucfirst($estado) }}
</span>
