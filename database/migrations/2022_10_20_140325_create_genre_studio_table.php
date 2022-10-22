<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_studio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studio_id')->constrained('studios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('genre_id')->constrained('genres')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_movies');
    }
};