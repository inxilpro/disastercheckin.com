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
            $table->string('zip');

            $table->timestamp('refill_requested_at')->nullable();
            $table->foreignIdFor(PhoneNumber::class, 'refill_requested_by')->nullable();

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
