<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('amount'); // amount in cents or smallest currency unit
            $table->string('destination'); // destination phone (M-Pesa)
            $table->enum('status', ['pending', 'approved', 'paid'])->default('pending');
            $table->string('transaction_code')->nullable(); // M-Pesa transaction or internal ref
            $table->text('notes')->nullable(); // optional admin notes or errors

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
