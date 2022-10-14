<?php

namespace Omalizadeh\ApiResponse\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeApiRequestCommand extends GeneratorCommand
{
    protected $name = 'make:api-request';
    protected $type = 'ApiRequest';

    protected function getStub()
    {
        return __DIR__.'/stubs/request.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the request class.'],
        ];
    }
}
