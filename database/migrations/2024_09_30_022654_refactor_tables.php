<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('phone_numbers');

        Schema::create('phone_numbers', function (Blueprint $table) {
            $table->snowflakeId();
            $table->string('value', 12);
            $table->boolean('is_opted_out')->after('phone')->default(false);
            $table->timestamps();
        });

        Schema::create('check_ins', function (Blueprint $table) {
            $table->snowflakeId();
            $table->foreignId('phone_number_id')->constrained();
            $table->string('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('check_ins');
        Schema::dropIfExists('phone_numbers');

        Schema::create('phone_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 10);
            $table->timestamp('stop_at')->nullable()->comment('User has opted out');
            $table->timestamps();
        });
    }
};
