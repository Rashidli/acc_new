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
        Schema::table('quotations', function (Blueprint $table) {
            $table->enum('status', [Status::PENDING, Status::APPROVED, Status::CANCELLED])
                ->default(Status::PENDING)
                ->comment('Status of the quotation: 1 - Pending, 2 - Approved, 3 - Cancelled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
