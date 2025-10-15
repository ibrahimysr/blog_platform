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
		Schema::create('post_media', function (Blueprint $table) {
			$table->id();
			$table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
			$table->tinyInteger('type');
			$table->string('url');
			$table->string('alt')->nullable();
			$table->string('caption')->nullable();
			$table->unsignedSmallInteger('sort_order')->default(0);
			$table->boolean('is_primary')->default(false);
			$table->timestampsTz();
			$table->softDeletes();
			$table->index(['post_id']);
			$table->index(['is_primary']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_media');
    }
};
