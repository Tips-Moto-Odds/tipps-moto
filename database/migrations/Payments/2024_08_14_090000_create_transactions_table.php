<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        //this is the table that stores all the payments for the basic, weekly and monthly subscription packages
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('currency');
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->string('payment_method');
            $table->string('package_id');
            $table->string('transaction_reference')->nullable();
            $table->string('transaction_type');
            $table->enum('transaction_status', ['successful', 'failed', 'pending'])->default('pending');
            $table->date('transaction_date')->nullable();
            $table->time('transaction_time')->nullable();
            $table->text('transaction_description')->nullable();
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
