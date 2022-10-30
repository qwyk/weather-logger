<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function loadStubData(string $stubName, string $directory, string $extension = '.php'): mixed
    {
        $path = sprintf(
            '%s%s%s',
            $directory,
            $stubName,
            $extension
        );
        $this->assertFileExists($path);
        return require $path;
    }
}
