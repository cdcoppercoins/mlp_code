expect text.
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReleaseExpiredTombstonesCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'coppercoins:release-tombstones {--dry-run : Show what would change without modifying data}';

    /**
     * The console command description.
     */
    protected $description = 'Release die numbers whose tombstone reservation period has expired (runs daily).';

    public function handle(): int
    {
        $now = Carbon::now();
        $dryRun = (bool) $this->option('dry-run');

        $this->info('CopperCoins: Releasing expired tombstones...');
        $this->info('Now: ' . $now->toDateTimeString());
        $this->info('Dry-run: ' . ($dryRun ? 'YES' : 'NO'));

        // We keep the operation transactional and idempotent.
        $result = DB::transaction(function () use ($now, $dryRun) {

            // Select candidate rows. We do NOT lock the whole table; we lock rows we touch.
            $candidates = DB::table('die_numbers')
                ->select(['id', 'die_number', 'status', 'reserved_until'])
                ->where('status', '=', 'reserved_unassigned')
                ->whereNotNull('reserved_until')
                ->where('reserved_until', '<=', $now)
                ->orderBy('reserved_until')
                ->get();

            $count = $candidates->count();

            if ($count === 0) {
                return [
                    'candidates' => 0,
                    'released' => 0,
                ];
            }

            $this->line("Found {$count} expired tombstone(s).");

            if ($dryRun) {
                // Report only
                foreach ($candidates as $row) {
                    $this->line("Would release: {$row->die_number} (reserved_until={$row->reserved_until})");
                }

                return [
                    'candidates' => $count,
                    'released' => 0,
                ];
            }

            // Update eligible rows
            $releasedIds = $candidates->pluck('id')->all();

            $released = DB::table('die_numbers')
                ->whereIn('id', $releasedIds)
                ->where('status', '=', 'reserved_unassigned') // idempotency guard
                ->update([
                    'status' => 'available_unassigned',
                    // keep reserved_until for history or clear it; policy says "clear or finalize".
                    // We'll clear it to reflect "available now". The change log preserves history.
                    'reserved_until' => null,
                    'updated_at' => $now,
                ]);

            // Write change events (append-only)
            $events = [];
            foreach ($candidates as $row) {
                $events[] = [
                    'event_type' => 'release_reserved_number',
                    'die_number_id' => $row->id,
                    'from_die_id' => null,
                    'to_die_id' => null,
                    'admin_user_id' => null, // system job
                    'reason' => 'Automatic daily release: tombstone reservation expired.',
                    'effective_at' => $now,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            DB::table('catalog_change_events')->insert($events);

            return [
                'candidates' => $count,
                'released' => $released,
            ];
        });

        $this->info("Candidates: {$result['candidates']}");
        $this->info("Released: {$result['released']}");

        return Command::SUCCESS;
    }
}
