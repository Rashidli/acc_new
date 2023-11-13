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
        if(!Schema::hasTable('expense_product')){
            Schema::create('expense_product', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('expense_id');
                $table->unsignedBigInteger('product_id');

                $table->string('quantity');
                $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_product');
    }
};
