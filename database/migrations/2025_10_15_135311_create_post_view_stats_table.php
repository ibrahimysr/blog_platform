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
		Schema::create('post_view_stats', function (Blueprint $table) {
			$table->id();
			$table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
			$table->date('date');
			$table->unsignedInteger('views')->default(0);
			$table->unsignedInteger('unique_views')->default(0);
			$table->timestampsTz();
			$table->unique(['post_id', 'date']);
			$table->index(['post_id', 'date']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_view_stats');
    }
};
