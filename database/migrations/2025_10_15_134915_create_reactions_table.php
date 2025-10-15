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
		Schema::create('reactions', function (Blueprint $table) {
			$table->id();
			$table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
			$table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
			$table->tinyInteger('value');
			$table->timestampTz('created_at')->useCurrent();
			$table->unique(['post_id', 'user_id']);
			$table->index(['post_id']);
			$table->index(['user_id']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
