<?php

namespace JeroenG\Cronlog\Tests;

use JeroenG\Cronlog\CronlogServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [CronlogServiceProvider::class];
    }
}
