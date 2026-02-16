<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('die_numbers', function (Blueprint $table) {
            $table->id();

            // Full formatted number (e.g., 1960D-1MM-042 or 1984S-50MM-001P)
            $table->string('die_number', 20)->unique();

            // Parsed components used for "lowest available" assignment and indexing
            $table->unsignedSmallInteger('year')->index();
            $table->string('mint', 2)->index();
            $table->unsignedSmallInteger('denom')->default(1)->index();
            $table->string('die_type', 2)->index();
            $table->boolean('proof')->default(false)->index();

            // This is the sortable sequential index within the group (001..999)
            $table->unsignedSmallInteger('index_num')->index();

            // Nullable assignment enables tombstones/unassigned slots
            $table->foreignId('die_id')->nullable()->constrained('dies')->nullOnDelete();

            // Status supports tombstones + released slots
            // assigned: die_id not null
            // reserved_unassigned: tombstone window active (die_id null)
            // available_unassigned: unassigned and eligible for lowest-available assignment
            $table->enum('status', ['assigned', 'reserved_unassigned', 'available_unassigned'])
                ->default('available_unassigned')
                ->index();

            // Tombstone hold expiration
            $table->dateTime('reserved_until')->nullable()->index();

            $table->timestamps();

            // Prevent duplicate numeric slots inside a group (critical safety constraint)
            $table->unique(['year', 'mint', 'denom', 'die_type', 'proof', 'index_num'], 'die_numbers_group_unique');

            // Helpful group index for fast “lowest available” lookups
            $table->index(['year', 'mint', 'denom', 'die_type', 'proof', 'status', 'index_num'], 'die_numbers_lowest_lookup_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('die_numbers');
    }
};
