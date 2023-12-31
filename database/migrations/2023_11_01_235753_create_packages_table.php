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
        if(!Schema::hasTable('packages')){
            Schema::create('packages', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('voen');
                $table->string('bank_account_number');
                $table->string('bank_code');
                $table->string('amount');
                $table->string('elect_invoice');
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
        Schema::dropIfExists('packages');
    }
};
