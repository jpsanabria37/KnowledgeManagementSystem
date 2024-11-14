<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- Logo del SENA -->
            <img src="{{ asset('img/logo_sena.png') }}" alt="Logo SENA" class="w-24 h-24 mx-auto mb-4">
        </x-slot>

        <!-- Encabezado del formulario de recuperación de contraseña -->
        <h1 class="text-2xl font-bold text-center text-green-700 mb-2">Recuperar Contraseña</h1>
        <p class="text-center text-gray-600 mb-6">
            Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
        </p>

        <!-- Validación de errores -->
        <x-validation-errors class="mb-4" />

        <!-- Formulario de recuperación de contraseña -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Campo de Correo Electrónico -->
            <div>
                <x-label for="email" value="Correo Electrónico" class="text-gray-700" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Botón para enviar el enlace de restablecimiento -->
            <div class="flex items-center justify-center mt-6">
                <x-button class="bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg px-4 py-2 transition duration-200">
                    Enviar Enlace de Recuperación
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
