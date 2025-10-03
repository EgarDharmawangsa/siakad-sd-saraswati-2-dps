<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'nip'  => 'NIP',
        ];

        Validator::resolver(function ($translator, $data, $rules, $messages, $customAttributes) use ($exceptions) {
            $validator = new \Illuminate\Validation\Validator($translator, $data, $rules, $messages, $customAttributes);

            $names = [];
            foreach ((array)$rules as $attribute => $rule) {
                if (!is_string($attribute)) continue;

                $names[$attribute] = $exceptions[$attribute] 
                    ?? ucwords(str_replace('_', ' ', $attribute));
            }

            $validator->setAttributeNames($names);

            return $validator;
        });
    }
}
