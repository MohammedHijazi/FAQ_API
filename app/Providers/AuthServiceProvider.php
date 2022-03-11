<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        Gate::define('active',function ($user){
            $time=Carbon::now()->diffInDays(Carbon::parse($user->valid_til));
            if($user->id==1) return true;
            else if($time>0) return true;
            else return false;
        });
    }
}
