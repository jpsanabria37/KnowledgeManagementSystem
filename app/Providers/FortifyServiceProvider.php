<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Support\Facades\Auth;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
    // Redirección personalizada después de logout
    $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
        public function toResponse($request)
        {
            return redirect('/'); // Redirigir al inicio después de logout
        }
    });

    // Redirección personalizada después de login
    $this->app->instance(LoginResponse::class, new class implements LoginResponse {
        public function toResponse($request)
        {
            // Obtener el usuario autenticado usando $request->user() en lugar de Auth::user()
            $user = $request->user();

            // Redirigir según el rol del usuario
            if ($user && $user->hasRole('admin')) {
                return redirect('/regionales'); // Dashboard del Admin
            } elseif ($user && $user->hasRole('instructor')) {
                return redirect('/instructor/dashboard'); // Dashboard del Instructor
            } elseif ($user && $user->hasRole('aprendiz')) {
                return redirect('/aprendiz/dashboard'); // Dashboard del Aprendiz
            }

            // Redirección por defecto si no tiene un rol específico
            return redirect('/dashboard');
        }
    });

    // Redirección personalizada después de register
    $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
        public function toResponse($request)
        {
            $user = $request->user(); // Obtener el usuario autenticado tras el registro

            // Redirigir según el rol del usuario
            if ($user && $user->hasRole('admin')) {
                return redirect('/regionales'); // Dashboard del Admin
            } elseif ($user && $user->hasRole('instructor')) {
                return redirect('/instructor/dashboard'); // Dashboard del Instructor
            } elseif ($user && $user->hasRole('aprendiz')) {
                return redirect('/aprendiz/dashboard'); // Dashboard del Aprendiz
            }

            // Redirección por defecto si no tiene un rol específico
            return redirect('/dashboard');
        }
    });
}
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
