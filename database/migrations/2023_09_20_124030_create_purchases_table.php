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
        if(!Schema::hasTable('purchases')){
            Schema::create('purchases', function (Blueprint $table) {
                $table->id();

                $table->string('purchase_number');
                $table->string('company');
                $table->string('date');
                $table->string('income_number');
                $table->string('electron_invoice');
                $table->string('debet');
                $table->string('credit');
                $table->string('without_adv');
                $table->string('amount_adv');
                $table->string('total_amount');
                $table->timestamps();
                $table->softDeletes();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
