<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Verifica tu email</h1>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            ¡Gracias por registrarte! Verifica tu dirección de correo haciendo clic en el enlace que acabamos de enviarte. Si no lo recibiste, te enviaremos otro encantados.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-700 dark:text-green-400">
            Se ha enviado un nuevo enlace de verificación a la dirección de correo que indicaste al registrarte.
        </div>
    @endif

    <div class="flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" x-data="{ enviando: false }" @submit="enviando = true">
            @csrf
            <button type="submit" :disabled="enviando"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-accent-600 hover:bg-accent-700 dark:bg-accent-500 dark:hover:bg-accent-400 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors disabled:opacity-60 disabled:cursor-not-allowed">
                <svg x-show="enviando" class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                <span x-text="enviando ? 'Enviando…' : 'Reenviar email de verificación'">Reenviar email de verificación</span>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">Cerrar sesión</button>
        </form>
    </div>
</x-guest-layout>
