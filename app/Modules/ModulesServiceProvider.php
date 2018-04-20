<?php

namespace App\Modules;

/**
 * ServiceProvider
 *
 * The service provider for the modules. After being registered
 * it will make sure that each of the modules are properly loaded
 * i.e. with their routes, views etc.
 *
 * @author kundan Roy <query@programmerlab.com>
 * @package App\Modules
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


class ModulesServiceProvider extends ServiceProvider {
    
    
    protected $namespace = 'App\Modules';
    /**
     * Will make sure that the required modules have been fully loaded
     *
     * @return void routeModule
     */
    public function boot() {
        
        
        // For each of the registered modules, include their routes and Views
        $modules = config("module.modules");
        
        foreach($modules as $module) {
            $routePath = base_path('app/Modules/'. $module.'/Route.php');
            
            $viewPath = base_path('app/Modules/'. $module.'/views');
            
            // Load the routes for each of the modules
            if (file_exists($routePath)) {
                
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group($routePath);
            }
            if (is_dir($viewPath)) {
                
                $this->loadViewsFrom($viewPath,$module);
            }
        }
        parent::boot();
    }

}