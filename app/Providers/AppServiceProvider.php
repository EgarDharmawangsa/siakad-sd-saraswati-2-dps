<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        Paginator::useBootstrap();

        $exceptions = [
            'nisn' => 'NISN',
            'nip'  => 'NIP'
        ];

        Validator::resolver(function ($translator, $data, $rules, $messages, $customAttributes) use ($exceptions) {
            $validator = new \Illuminate\Validation\Validator($translator, $data, $rules, $messages, $customAttributes);

            $names = [];
            foreach ((array)$rules as $attribute) {
                if (!\is_string($attribute)) continue;

                $names[$attribute] = $exceptions[$attribute]
                    ?? ucwords(str_replace('_', ' ', $attribute));
            }

            $validator->setAttributeNames($names);

            return $validator;
        });

        // Main Gates
        Gate::define('staf-tata-usaha', fn($user) => $user->role === 'Staf Tata Usaha');
        Gate::define('guru', fn($user) => $user->role === 'Guru');
        Gate::define('siswa', fn($user) => $user->role === 'Siswa');

        // Specific Gate
        Gate::define('pegawai-profile-edit', fn($user) => $user->role === 'Staf Tata Usaha' || ($user->role === 'Guru' && request()->routeIs('profil')));
    }
}
