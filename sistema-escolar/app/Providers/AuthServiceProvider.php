<?php

namespace App\Providers;
 
use App\Models\Ocorrencia;
use App\Policies\OcorrenciaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
 
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Ocorrencia::class => OcorrenciaPolicy::class,
    ];
 
    public function boot(): void
    {
        $this->registerPolicies();
    }
}