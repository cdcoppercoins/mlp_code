<?php

/**
 * Copy this snippet into app/Console/Kernel.php inside the schedule() method.
 *
 * Example location:
 * protected function schedule(Schedule $schedule): void
 * {
 *     // paste below
 * }
 */

use Illuminate\Console\Scheduling\Schedule;

$schedule->command('coppercoins:release-tombstones')
    ->dailyAt('02:15')   // choose a quiet time
    ->onOneServer()      // safe if you ever run multiple workers/servers
    ->withoutOverlapping(30); // prevents overlap if a run gets stuck
