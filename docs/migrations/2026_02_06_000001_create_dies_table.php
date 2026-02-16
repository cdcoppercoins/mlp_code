<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dies', function (Blueprint $table) {
            $table->id();

            // Minimal canonical identity fields (we can expand later)
            $table->unsignedSmallInteger('year')->index();         // 1909–current
            $table->string('mint', 2)->index();                    // P, D, S
            $table->unsignedSmallInteger('denom')->default(1);     // cents = 1, etc.
            $table->string('die_type', 2)->index();                // DO, DR, MM, OM, RD, OD
            $table->boolean('proof')->default(false)->index();

            // Notes/classification (optional placeholders)
            $table->text('notes')->nullable();

            // Soft deletes optional; enable if you want to avoid hard deletes later
            // $table->softDeletes();

            $table->timestamps();

            // Helps grouping queries (lowest-available rule uses die_numbers, but dies are often filtered similarly)
            $table->index(['year', 'mint', 'denom', 'die_type', 'proof'], 'dies_group_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dies');
    }
};
