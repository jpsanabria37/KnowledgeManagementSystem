<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $instructorRole = Role::firstOrCreate(['name' => 'instructor']);
        $aprendizRole = Role::firstOrCreate(['name' => 'aprendiz']);

        // Crear el usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Cambia el correo electrónico si prefieres otro
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'), // Cambia la contraseña si lo deseas
            ]
        );

        // Asignar el rol de administrador al usuario
        $admin->assignRole($adminRole);

        echo "Usuario administrador creado exitosamente con email: admin@example.com y contraseña: password123\n";
    }
}
