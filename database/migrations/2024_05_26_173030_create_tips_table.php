<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->id();
            $table->timestamp('match_start_time')->nullable();
            $table->string('home_teams');
            $table->string('away_teams');
            $table->decimal('home_odds', 5, 2);
            $table->decimal('draw_odds', 5, 2);
            $table->decimal('away_odds', 5, 2);
            $table->string('predictions');
            $table->string('status')->default('pending');

            // Define enum options for match confidence and league
            $table->enum('match_confidence', ['min', 'avg', 'max']);
            $table->string('league');
            $table->json('extra_odds')->nullable();

            // Updated fields
            $table->decimal('predictions_accuracy', 4, 2)->nullable();
            $table->string('winning_status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tips');
    }
};
