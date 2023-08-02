<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The CreateBooksTable migration.
 *
 * This migration creates the 'books' table in the database to store information about books.
 * It adds columns for title, author, image, and timestamps (created_at and updated_at).
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string(column:"title");
            $table->string(column:"author");
            $table->string(column:"image");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
