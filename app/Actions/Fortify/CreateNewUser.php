<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
       
        // Validar los datos de entrada
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                // Validar dominios permitidos
                'regex:/@(misena|soysena|sena)\.edu\.co$/',
            ],
            'password' => $this->passwordRules(), // Usar las reglas de contraseña definidas
            'ficha' => ['required', 'string', 'max:20'], // Campo para la ficha
            'programa' => ['required', 'string', 'max:255'], // Campo para el programa
        ])->validate();

        // Crear el usuario
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'ficha' => $input['ficha'], // Guardar el campo de ficha
            'programa' => $input['programa'], // Guardar el campo de programa
        ]);

        // Asignar el rol "aprendiz" al usuario recién creado
        $user->assignRole('aprendiz');

        return $user;
    }
}
