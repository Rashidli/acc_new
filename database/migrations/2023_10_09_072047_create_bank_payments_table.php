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
        Schema::create('bank_payments', function (Blueprint $table) {
            $table->id();
            $table->string('electron_invoice');
            $table->string('debet');
            $table->string('credit');
            $table->integer('voen');
            $table->string('company');
            $table->string('date');
            $table->string('payment_type');
            $table->string('payment_amount');
            $table->string('bank');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_payments');
    }
};
