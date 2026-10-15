<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This creates the "todos" table in MySQL
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();                          // Auto-increment primary key
            $table->string('title');               // Todo title (required)
            $table->text('description')->nullable(); // Optional description
            $table->boolean('is_completed')->default(false); // Completed status
            $table->timestamps();                  // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations (drop the table).
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
