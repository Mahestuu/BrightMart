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
        Schema::create('chatmessages', function (Blueprint $table) {
            $table->id('chatmessage_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->string('guest_id')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('message');
            $table->enum('sender', ['user', 'bot']);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            
            // Index untuk performa
            $table->index(['guest_id', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatmessages');
    }
};
