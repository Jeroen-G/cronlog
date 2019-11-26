<?php

namespace JeroenG\Cronlog\Tests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;

class CronlogTest extends TestCase
{
    public function test_command_is_logged()
    {
        $schedule = app()->make(Schedule::class);

        Storage::fake('local');

        $schedule
             ->command('inspire')
             ->everyMinute()
             ->cronlog();

        $this->artisan('schedule:run')
             ->assertExitCode(0);

        $filename = '36fb0fb6688b4ef0a6a4d2086790a00cc452eb8d.log';

        Storage::disk('local')->assertExists($filename);
    }
}
