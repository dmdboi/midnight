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
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->constrained()->onDelete('cascade');
            $table->foreignUlid('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('body'); // first post content
            $table->string('slug')->unique();

            $table->boolean('is_pinned')->default(false); // Indicates if the thread is pinned to the top of the board
            $table->timestamp('pinned_at')->nullable();
            $table->timestamp('pinned_until')->nullable();
            $table->foreignUlid('pinned_by_user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->boolean('is_hidden')->default(false); // Indicates if the thread is hidden from public view
            $table->timestamp('hidden_at')->nullable();
            $table->timestamp('hidden_until')->nullable();
            $table->foreignUlid('hidden_by_user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->boolean('is_locked')->default(false);
            $table->string('locked_reason')->nullable();

            $table->string('status')->default('open'); // Status of the thread (open, closed, archived)
            $table->timestamp('closed_at')->nullable(); // When the thread was closed
            $table->foreignUlid('closed_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};
