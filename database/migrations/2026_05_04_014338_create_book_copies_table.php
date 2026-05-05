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
        Schema::create('book_copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
            $table->foreignId('book_stand_id')->nullable()->constrained('book_stands')->nullOnDelete();
            $table->string('accession_no')->nullable()->unique();
            $table->enum('condition', ['new', 'good', 'fair', 'damaged'])->default('good');
            $table->enum('status', ['available','borrowed','pending_return','reserved','lost','damaged'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_copies');
    }
};
