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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();

            $table->foreignId('referred_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('referral_code')->nullable()->unique();

            $table->unsignedBigInteger('total_referrals')->default(0);
            $table->decimal('total_earnings', 10, 2)->default(0.00);
            $table->decimal('withdrawn_amount', 10, 2)->default(0.00);

            $table->timestamps();
            $table->softDeletes(); // Enables soft deletes

            $table->index(['user_id', 'referral_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};

