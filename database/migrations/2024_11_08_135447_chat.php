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
    // Conversations table to represent each chat session or group chat
    Schema::create('conversations', function (Blueprint $table) {
      $table->id(); // Primary key
      $table->timestamps(); // Created at and updated at
    });

    // User conversations pivot table to connect users with conversations
    Schema::create('user_conversations', function (Blueprint $table) {
      $table->id(); // Primary key
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->foreignId('conversation_id')->constrained('conversations')->onDelete('cascade');
      $table->timestamps(); // Optional: to track when user joined the conversation

      $table->unique(['user_id', 'conversation_id']); // Prevent duplicate entries
    });


    Schema::create('messages', function (Blueprint $table) {
      $table->id(); // Primary key
      $table->foreignId('conversation_id')->constrained('conversations')->onDelete('cascade');
      $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // User who sent the message
      $table->text('content');
      $table->timestamps();
    });


    Schema::create('read_receipts', function (Blueprint $table) {
      $table->id(); // Primary key
      $table->foreignId('message_id')->constrained('messages')->onDelete('cascade');
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->timestamp('read_at')->nullable(); // Timestamp for when the message was read
      $table->timestamps();

      $table->unique(['message_id', 'user_id']); // Prevent duplicate entries
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('read_receipts');
    Schema::dropIfExists('messages');
    Schema::dropIfExists('user_conversations');
    Schema::dropIfExists('conversations');
  }
};
