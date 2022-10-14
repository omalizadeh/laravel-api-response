<?php

namespace Omalizadeh\ApiResponse;

use Illuminate\Support\ServiceProvider;
use Omalizadeh\ApiResponse\Console\MakeApiRequestCommand;
use Omalizadeh\ApiResponse\Console\MakeApiResourceCommand;

class ApiResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            MakeApiResourceCommand::class,
            MakeApiRequestCommand::class,
        ]);
    }

    public function boot()
    {
        //
    }
}
