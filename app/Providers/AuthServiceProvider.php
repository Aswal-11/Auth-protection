<?php

namespace App\Providers;

use App\Policies\BasePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    public function boot(): void
    {
        $this->registerPolicies();
        Gate::policy(Model::class, BasePolicy::class);
    }
}

