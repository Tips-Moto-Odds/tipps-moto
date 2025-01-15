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
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('generated_by');
            $table->string('prediction_type');
            $table->string('predictions');
            $table->string('status')->default('pending');
            $table->enum('prediction_confidence', ['min', 'avg', 'max']);
            $table->decimal('predictions_accuracy', 4, 2)->nullable();
            $table->string('winning_status')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('match_id')
                ->references('id')
                ->on('matches')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
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
