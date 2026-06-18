<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Confirmar contraseña</h1>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Esta es un área segura de la aplicación. Confirma tu contraseña antes de continuar.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" x-data="{ enviando: false }" @submit="enviando = true" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <button type="submit" :disabled="enviando"
                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-accent-600 hover:bg-accent-700 dark:bg-accent-500 dark:hover:bg-accent-400 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors disabled:opacity-60 disabled:cursor-not-allowed">
            <svg x-show="enviando" class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
            <span x-text="enviando ? 'Confirmando…' : 'Confirmar'">Confirmar</span>
        </button>
    </form>
</x-guest-layout>
