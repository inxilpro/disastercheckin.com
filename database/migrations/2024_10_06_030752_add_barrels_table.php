<?php

use App\Models\PhoneNumber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barrels', function (Blueprint $table) {
            $table->snowflakeId();

            $table->string('code')->unique();

            $table->string('address_street');
            $table->string('address_city');
            $table->string('address_state');
            $table->string('address_zip');

            $table->timestamp('refill_requested_at')->nullable();
            $table->string('refill_requested_by')->nullable();

            $table->timestamp('refilled_at')->nullable();
            $table->string('refilled_by')->nullable();
            
            $table->timestamp('decommissioned_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barrels');
    }
};
