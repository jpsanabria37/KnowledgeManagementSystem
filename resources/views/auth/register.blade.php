<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- Logo del SENA -->
            <img src="{{ asset('img/logo_sena.png') }}" alt="Logo SENA" class="w-24 h-24 mx-auto mb-4">
        </x-slot>

        <!-- Encabezado del formulario de registro -->
        <h1 class="text-3xl font-bold text-center text-green-700 mb-2">Registro</h1>
        <p class="text-center text-gray-600 mb-6">Únete a la plataforma de gestión de anteproyectos del SENA</p>

        <!-- Validación de errores -->
        <x-validation-errors class="mb-4" />

        <!-- Formulario de registro -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Campo de Nombre -->
            <div>
                <x-label for="name" value="Nombre" class="text-gray-700" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Campo de Correo Electrónico -->
            <div class="mt-4">
                <x-label for="email" value="Correo Electrónico" class="text-gray-700" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Campo de Contraseña -->
            <div class="mt-4">
                <x-label for="password" value="Contraseña" class="text-gray-700" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Campo de Confirmación de Contraseña -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="Confirmar Contraseña" class="text-gray-700" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Términos y condiciones -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" class="text-green-600 focus:ring-green-500" required />
                            <div class="ml-2 text-sm text-gray-700">
                                {!! __('Estoy de acuerdo con los :terms_of_service y la :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-green-600 hover:text-green-800">'.__('Términos de Servicio').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-green-600 hover:text-green-800">'.__('Política de Privacidad').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <!-- Botón de registro y enlace a iniciar sesión -->
            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-green-600 hover:text-green-800 font-semibold" href="{{ route('login') }}">
                    ¿Ya tienes una cuenta?
                </a>

                <x-button class="ml-4 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg px-4 py-2 transition duration-200">
                    Registrarse
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
