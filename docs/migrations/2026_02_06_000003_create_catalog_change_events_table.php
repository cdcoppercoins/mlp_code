<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catalog_change_events', function (Blueprint $table) {
            $table->id();

            $table->enum('event_type', [
                'merge_number_into_canonical',
                'reserve_number_unassigned',
                'release_reserved_number',
                'assign_number_to_die',
                'reassign_number_to_new_die',
            ])->index();

            // The die number this event is about
            $table->foreignId('die_number_id')->constrained('die_numbers')->cascadeOnDelete();

            // Optional context (helps explain events cleanly)
            $table->foreignId('from_die_id')->nullable()->constrained('dies')->nullOnDelete();
            $table->foreignId('to_die_id')->nullable()->constrained('dies')->nullOnDelete();

            // Who did it (assumes users table exists later; can be nullable for system jobs)
            $table->unsignedBigInteger('admin_user_id')->nullable()->index();

            // Human readable reason (required for admin actions; for jobs can be system-generated)
            $table->text('reason')->nullable();

            // When the change took effect (often = created_at, but kept explicit)
            $table->dateTime('effective_at')->index();

            $table->timestamps();

            // Useful for ordering recent changes on home page
            $table->index(['effective_at', 'event_type'], 'catalog_change_events_recent_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_change_events');
    }
};
