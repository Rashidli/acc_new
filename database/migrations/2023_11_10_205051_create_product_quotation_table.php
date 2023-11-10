<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_quotation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quotation_id');
            $table->decimal('price');
            $table->string('unit');
            $table->string('code');
            $table->timestamps();

            // Foreign keys
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('quotation_id')->references('id')->on('quotations');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_quotation');
    }
};
