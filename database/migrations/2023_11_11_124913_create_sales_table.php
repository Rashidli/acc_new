<?php

use App\Enums\Status;
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
        Schema::create('sales', function (Blueprint $table) {

            $table->id();
            $table->string('sale_number');
            $table->unsignedBigInteger('quotation_id');
            $table->enum('status', [Status::PENDING, Status::APPROVED, Status::CANCELLED])
                ->default(Status::PENDING)
                ->comment('1 - Pending, 2 - Approved, 3 - Cancelled');
            $table->string('company');
            $table->string('contract');
            $table->date('date');
            $table->string('tax')->nullable();
            $table->decimal('tax_fee')->default(null);
            $table->decimal('sub_total')->default(null);
            $table->decimal('total_amount');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
