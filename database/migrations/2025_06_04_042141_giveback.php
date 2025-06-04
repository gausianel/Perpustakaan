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
    Schema::create('givebacks', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('borrowed_id');
    $table->date('date_returned');
    $table->timestamps();

    $table->foreign('borrowed_id')->references('id')->on('borroweds')->onDelete('cascade');
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('givebacks');
    }
};