<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


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
    
    Validator::extend('unique_based_on_flag', function ($attribute, $value, $parameters, $validator) {
        
        $existingDepartment = \App\Models\Department::where('dept_name', $value)
            ->where('flag', 'show')
            ->exists();
        dd($existingDepartment);
        // If the department with the same name and flag 'show' exists, return false
        return !$existingDepartment;
    });
}

}
