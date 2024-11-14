<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- Logo del SENA -->
            <img src="{{ asset('img/logo_sena.png') }}" alt="Logo SENA" class="w-24 h-24 mx-auto mb-4">
        </x-slot>

        <!-- Mensaje de bienvenida y subtítulo -->
        <h1 class="text-3xl font-bold text-center text-green-700 mb-2">Iniciar Sesión</h1>
        <p class="text-center text-gray-600 mb-6">Bienvenido a la plataforma de gestión de anteproyectos del SENA</p>

        <!-- Validación de errores -->
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="Correo Electrónico" class="text-gray-700" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Contraseña" class="text-gray-700" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="text-green-600 focus:ring-green-500" />
                    <span class="ml-2 text-sm text-gray-700">Recordarme</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-green-600 hover:text-green-800" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <x-button class="ml-4 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg px-4 py-2 transition duration-200">
                    Iniciar Sesión
                </x-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600">¿No tienes una cuenta?</p>
            <a href="{{ route('register') }}" class="underline text-green-600 hover:text-green-800 font-semibold">Regístrate aquí</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
