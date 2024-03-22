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

        // If the department with the same name and flag 'show' exists, return false
        if ($existingDepartment) {
            return false;
        } else {
            // If the department doesn't exist or if it doesn't have the flag 'show', return true
            return true;
        }
    });

    Validator::extend('unique_designation_based_on_flag', function ($attribute, $value, $parameters, $validator) {
                        
        // Check if a designation with the given name and flag 'show' exists
        $existingDesignation = \App\Models\Designation::where('designation_name', $value)
            ->where('flag', 'show')
            ->exists();
           
        if ($existingDesignation) {
            return false;
        } else {
            // If the department doesn't exist or if it doesn't have the flag 'show', return true
            return true;
        }    
        });

        Validator::extend('unique_role_based_on_flag', function ($attribute, $value, $parameters, $validator) {
                    
        // Check if a designation with the given name and flag 'show' exists
        $existingRole = \App\Models\Role::where('role_name', $value)
            ->where('flag', 'show')
            ->exists();
            
        if ($existingRole) {
            return false;
        } else {
            // If the department doesn't exist or if it doesn't have the flag 'show', return true
            return true;
        }    
        });    

        Validator::extend('unique_tech_based_on_flag', function ($attribute, $value, $parameters, $validator) {
                    
            // Check if a designation with the given name and flag 'show' exists
            $existingTech = \App\Models\Technology::where('tech_name', $value)
                ->where('flag', 'show')
                ->exists();
                
            if ($existingTech) {
                return false;
            } else {
                // If the department doesn't exist or if it doesn't have the flag 'show', return true
                return true;
            }    
            });

        Validator::extend('unique_docType_based_on_flag', function ($attribute, $value, $parameters, $validator) {
                
            // Check if a designation with the given name and flag 'show' exists
            $existingDocType = \App\Models\DocumentType::where('doc_type', $value)
                ->where('flag', 'show')
                ->exists();
                
            if ($existingDocType) {
                return false;
            } else {
                // If the department doesn't exist or if it doesn't have the flag 'show', return true
                return true;
            }    
            });    


}

}
