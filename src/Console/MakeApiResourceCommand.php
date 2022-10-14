<?php

namespace Omalizadeh\ApiResponse\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeApiResourceCommand extends GeneratorCommand
{
    protected $name = 'make:api-resource';
    protected $type = 'ApiResource';

    protected function getStub()
    {
        return __DIR__.'/stubs/resource.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Resources';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the resource class.'],
        ];
    }
}
