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
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('excerpt')->nullable();
			$table->longText('content');
			$table->tinyInteger('status')->default(0);
			$table->timestampTz('published_at')->nullable();
			$table->boolean('is_featured')->default(false);
			$table->unsignedSmallInteger('reading_time')->default(0);
			$table->unsignedBigInteger('views')->default(0);
			$table->timestampsTz();
			$table->softDeletes();
			$table->index(['status']);
			$table->index(['published_at']);
			$table->index(['is_featured']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
