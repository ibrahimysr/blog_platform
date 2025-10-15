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
		Schema::create('events', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
			$table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
			$table->string('title');
			$table->string('slug')->unique();
			$table->text('description');
			$table->timestampTz('event_date');
			$table->string('location')->nullable();
			$table->string('media_url')->nullable();
			$table->tinyInteger('status')->default(1);
			$table->timestampsTz();
			$table->softDeletes();
			$table->index(['event_date']);
			$table->index(['status']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
