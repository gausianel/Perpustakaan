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
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->foreignId('genre_id')->constrained('genres')->onDelete('cascade');
        $table->string('title');
        $table->string('author');
        $table->string('publisher');
        $table->integer('year');
        $table->unsignedInteger('stock'); // Tambahan kolom stok buku
        $table->string('cover_image')->nullable(); // boleh kosong
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
