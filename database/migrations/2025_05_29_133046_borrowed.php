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
    Schema::create('borroweds', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('book_id');
        $table->unsignedBigInteger('user_id');
         $table->date('borrowed_date');  
        $table->date('expected_return_date')->nullable(); // tanggal target pengembalian
        $table->boolean('is_returned')->default(false);   // status pengembalian
        $table->timestamps();

        $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borroweds');
    }
};
