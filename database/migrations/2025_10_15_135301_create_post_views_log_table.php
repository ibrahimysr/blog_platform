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
		Schema::create('post_views_log', function (Blueprint $table) {
			$table->id();
			$table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
			$table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
			$table->string('ip_address', 45)->nullable();
			$table->text('user_agent')->nullable();
			$table->timestampTz('viewed_at')->useCurrent();
			$table->index(['post_id']);
			$table->index(['viewed_at']);
			$table->index(['post_id', 'user_id']);
			$table->index(['post_id', 'ip_address', 'viewed_at']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_views_log');
    }
};
