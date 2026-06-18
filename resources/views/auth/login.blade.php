<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Iniciar sesión</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Bienvenido de nuevo.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" x-data="{ enviando: false }" @submit="enviando = true" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-accent-600 focus:ring-accent-500">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Recuérdame</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            @endif
        </div>

        <button type="submit" :disabled="enviando"
                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-accent-600 hover:bg-accent-700 dark:bg-accent-500 dark:hover:bg-accent-400 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors disabled:opacity-60 disabled:cursor-not-allowed">
            <svg x-show="enviando" class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
            <span x-text="enviando ? 'Entrando…' : 'Iniciar sesión'">Iniciar sesión</span>
        </button>

        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="font-medium text-accent-700 dark:text-accent-400 hover:underline">Regístrate</a>
            </p>
        @endif
    </form>
</x-guest-layout>
