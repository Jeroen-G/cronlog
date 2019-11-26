<?php

namespace JeroenG\Cronlog\Tests;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Storage;

class CronlogTest extends TestCase
{
    public function test_command_is_logged()
    {
        Storage::fake('local');

        app()->make(Schedule::class)
             ->command('inspire')
             ->everyMinute()
             ->cronlog();

        $this->artisan('schedule:run')
             ->assertExitCode(0);

        $this->assertCount(1, Storage::disk('local')->files());
    }
}
