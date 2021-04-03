<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Models\Settings;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('settings')) {
            foreach (Settings::all() as $setting) {
                Config::set('settings.'.$setting->key, $setting->value);
            }
        }

        view()->composer('*', function ($view) 
        {
            if (Auth::guard('bigg')->check()) {
                $view->with('user', Auth::guard('bigg')->user());
            }else {
                $view->with('user', null);
            }

            $notifications = Notification::select('activity_log.description', 'activity_log.updated_at', 'biggs.name as name', 'biggs.email as email')
                            ->join('biggs', 'biggs.id', '=', 'activity_log.causer_id')
                            ->limit(5)
                            ->orderBy('updated_at', 'desc')->get();
    
            $view->with('notifications', $notifications );    
        });  
    }
}
