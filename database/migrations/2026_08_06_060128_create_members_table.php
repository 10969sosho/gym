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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_id')->unique();
            $table->string('name');
            $table->string('whatsapp')->unique();
            $table->string('photo')->nullable();
            $table->string('membership_package');
            $table->date('start_date');
            $table->date('expired_date');
            $table->enum('status', ['active', 'expired', 'inactive'])->default('active');
            $table->string('qr_code')->nullable();
            $table->string('login_token')->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
