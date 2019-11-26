<?php

namespace JeroenG\Cronlog;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class CronlogServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        $this->registerMacro();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cronlog.php', 'cronlog');
    }

    /**
     * Console-specific booting.
     */
    private function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/cronlog.php' => config_path('cronlog.php'),
        ], 'cronlog.config');
    }

    /**
     * Add a macro to the Scheduling event to enable logging the output of cron jobs.
     */
    private function registerMacro(): void
    {
        Event::macro('cronlog', function() {
            $this->ensureOutputIsBeingCaptured();

            return $this->then(function (?string $disk = null) {
                $disk = $disk ?? config('cronlog.disk');
                $filename = sha1($this->mutexName()).'.log';
                $output = file_exists($this->output) ? file_get_contents($this->output) : '';
                Storage::disk($disk)->put($filename, $output);
            });
        });
    }
}
